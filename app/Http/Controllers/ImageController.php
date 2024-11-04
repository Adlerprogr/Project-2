<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;

class ImageController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function store(ImageRequest $request): JsonResponse
    {
        $image = $this->imageService->upload($request->file('images'));

        return response()->json(['images' => $image], 201);
    }
}
