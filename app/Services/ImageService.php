<?php

namespace App\Services;

use App\DTO\ProductDTO;
use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class ImageService
{
    protected ProductService  $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function handleImageUpload(ProductDTO $productDTO)
    {
        try {
            if ($productDTO->image) {
                $filePath = $productDTO->image->store('images', 'public');
                $imageName = $productDTO->image->getClientOriginalName();

                $imageRecord = Image::create([
                    'way' => $filePath,
                    'name' => $imageName,
                ]);

                return $imageRecord->id;
            }

            throw new \InvalidArgumentException('Изображение обязательно для загрузки.');
        } catch (\Exception $e) {
            Log::error('Ошибка при загрузке изображения: ' . $e->getMessage());
            throw new \Exception('Ошибка при загрузке изображения.');
        }
    }

    public function upload(UploadedFile $file): Image
    {
        $filePath = $file->store('images', 'public');
        $image = Image::create([
            'way' => $filePath,
            'name' => $file->getClientOriginalName(),
        ]);

        return $image;
    }
}
