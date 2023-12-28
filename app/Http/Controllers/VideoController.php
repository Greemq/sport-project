<?php

namespace App\Http\Controllers;

use App\Models\VideoGallery;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        return response()->json(VideoGallery::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required',
        ],[
            'link.*' => 'Обязательное поле'
        ]);

        $video = VideoGallery::create($request->validated());
        return response()->json(asset($video->link));
    }

    public function destroy($id)
    {
        VideoGallery::where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}
