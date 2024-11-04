<?php

namespace App\Services;

use App\Models\Image;
use App\DTO\ProductDTO;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductService
{
    public function createProduct(ProductDTO $productDTO)
    {
        return Product::create($productDTO->toArray());
    }
}
