<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Product;

class RouteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_checks_welcome_page_requires_auth()
    {
        $response = $this->get('/');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /** @test */
    public function it_checks_register_page_is_accessible()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    /** @test */
    public function it_checks_register_submission_works()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertStatus(302);
    }

    /** @test */
    public function it_checks_login_page_is_accessible()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    /** @test */
    public function it_checks_login_submission_works()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function it_checks_logout_submission_works()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/logout');
        $response->assertStatus(302);
        $this->assertGuest();
    }

    /** @test */
    public function it_checks_main_page_requires_auth()
    {
        $response = $this->get('/main');
        $response->assertStatus(302);
    }

    /** @test */
    public function it_checks_main_page_is_accessible_for_authenticated_users()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get('/main');
        $response->assertStatus(200);
    }

    /** @test */
    public function it_checks_cart_page_requires_auth()
    {
        $response = $this->get('/cart');
        $response->assertStatus(302);
    }

    /** @test */
    public function it_checks_cart_page_is_accessible_for_authenticated_users()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get('/cart');
        $response->assertStatus(200);
    }

    /** @test */
    public function it_checks_plus_product_route_requires_auth()
    {
        $response = $this->post('/plus-product', ['product_id' => 1]);
        $response->assertStatus(302);
    }

    /** @test */
    public function it_checks_delete_product_route_requires_auth()
    {
        $response = $this->post('/delete-product', ['product_id' => 1]);
        $response->assertStatus(302);
    }

    /** @test */
    public function it_checks_product_page_is_accessible_for_authenticated_users()
    {
        $user = User::factory()->create();
        $category = \App\Models\Category::factory()->create(); // Создаем категорию
        $product = Product::factory()->create(['category_id' => $category->id]); // Продукт с существующей категорией

        $this->actingAs($user);
        $response = $this->get('/product/' . $product->id);
        $response->assertStatus(200);
    }

    /** @test */
    public function it_checks_order_page_requires_auth()
    {
        $response = $this->get('/order');
        $response->assertStatus(302);
    }

    /** @test */
    public function it_checks_order_page_is_accessible_for_authenticated_users()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get('/order');
        $response->assertStatus(200);
    }

    /** @test */
    public function it_checks_order_add_route_requires_auth()
    {
        $response = $this->post('/order.add', ['product_id' => 1, 'quantity' => 1]);
        $response->assertStatus(302);
    }

    /** @test */
    public function it_checks_convert_prices_route_requires_auth()
    {
        $response = $this->post('/convert-prices');
        $response->assertStatus(302);
    }

    /** @test */
    public function it_checks_show_in_rubles_route_requires_auth()
    {
        $response = $this->post('/show-in-rubles');
        $response->assertStatus(302);
    }
}
