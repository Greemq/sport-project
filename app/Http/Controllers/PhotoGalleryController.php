<?php

namespace App\Http\Controllers;

use App\Http\Resources\PhotoGalleryResource;
use App\Models\PhotoGallery;
use Illuminate\Http\Request;

class PhotoGalleryController extends Controller
{
    public function index(Request $request)
    {
        return PhotoGallery::paginate(20);
    }

    public function store(Request $request)
    {
        $request->validate([
            'path' => 'required',
        ],);

        $photo = PhotoGallery::create(['path' => $request->path]);
        return ['success' => true, 'id' => $photo->id];
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:6048',
        ],
            [
                'path.*' => 'Фото должно быть формата jpeg, png, jpg, gif, svg и не более 6 МБ'
            ]);

        $photo = PhotoGallery::find($id)->update(['path' => $request->img]);
        return ['success' => true, 'id' => $photo->id];
    }

    public function item($id)
    {
        return PhotoGallery::find($id);
    }

    public function destroy($id)
    {
        PhotoGallery::where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}
