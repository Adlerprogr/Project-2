<?php

namespace App\Http\Controllers;

use App\DTO\ProductDTO;
use App\Http\Requests\ImageRequest;
use App\Models\Category;
use App\Services\ImageService;
use App\Services\ProductService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AddProductController extends Controller
{
    protected ProductService $productService;
    protected ImageService $imageService;

    public function __construct(ProductService $productService, ImageService $imageService)
    {
        $this->productService = $productService;
        $this->imageService = $imageService;
    }

    public function page()
    {
        $categories = Category::all();

        return view('addProduct', compact('categories'));
    }

    public function add(ImageRequest $request)
    {
        $productDTO = new ProductDTO($request);

        try {
            DB::transaction(function () use ($productDTO) {
                $productDTO->image_id = $this->imageService->handleImageUpload($productDTO);
                $this->productService->createProduct($productDTO);
            });

            return redirect()->route('main')->with('success', 'Продукт успешно добавлен!');
        } catch (\Throwable $e) {
            Log::error('Ошибка при добавлении продукта', [
                'message' => $e->getMessage(),
                'product_data' => $productDTO,
                'exception' => $e,
            ]);

            return redirect()->back()->withErrors(['general' => 'Ошибка при добавлении продукта.']);
        }
    }
}
