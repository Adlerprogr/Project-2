<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
//    public function image()
//    {
//        return view('image');
//    }
//
//    public function imageAdd(Request $request)
//    {
//        $request->validate([
//            'image' => 'required|image|max:2048', // Проверка на наличие изображения, формат и размер
//        ]);
//
//        $imageName = time() . '_' . $request->image->getClientOriginalName(); // Сгенерировать уникальное имя файла
//        $request->image->move(public_path('image'), $imageName); // Переместить файл в папку 'image'
//
//        // Сохранить информацию о изображении в базе данных
//        $image = Image::create([
//            'way' => 'images/' . $imageName, // Путь к изображению
//            'name' => $imageName,
//        ]);
//
//        return response()->json([
//            'success' => true,
//            'image' => $image,
//        ]);
//    }
}
