<?php

namespace App\Http\Controllers;

use App\Models\VideoGallery;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        return VideoGallery::paginate(20);
    }

    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required|url',
            'img' => 'required',
            'title' => 'required',
            'description' => 'required',
            'date' => 'required'
        ]);

        $video = VideoGallery::create($request->all());
        return ['success' => true, 'id' => $video->id];
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'link' => 'required|url',
            'img' => 'required',
            'title' => 'required',
            'description' => 'required',
            'date' => 'required'
        ]);

        VideoGallery::find($id)->update($request->all());
        return ['success' => true];
    }

    public function item($id)
    {
        return VideoGallery::find($id);
    }

    public function destroy($id)
    {
        VideoGallery::where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}
