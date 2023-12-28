<?php

namespace App\Http\Controllers;

use App\Http\Resources\PhotoGalleryResource;
use App\Models\PhotoGallery;
use Illuminate\Http\Request;

class PhotoGalleryController extends Controller
{
    public function index()
    {
        return PhotoGalleryResource::collection(PhotoGallery::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:6048',
        ],[
            'img.*' => 'Фото должно быть формата jpeg, png, jpg, gif, svg и не более 6 МБ'
        ]);
        $imageName = time() . '.' . $request->img->extension();
        $request->img->move(public_path('storage/photo_gallery'), $imageName);
        $photo = PhotoGallery::create(['path' => 'storage/photo_gallery/' . $imageName]);
        return response()->json(asset($photo->path));
    }

    public function destroy($id)
    {
        PhotoGallery::where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}
