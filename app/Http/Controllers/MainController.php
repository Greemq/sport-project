<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Spatie\Image\Image;

class MainController extends Controller
{
    public function uploadFile(Request $request)
    {
        $request->validate(['type' => 'required']);

        $file = $request->file('file');
        $full_file = Str::random(20) . '.' . pathinfo($file->getClientOriginalName())['extension'];
        if ($request->type == 'news') {
            $file->storeAs('public/news/', $full_file);
            $name = '/storage/news/' . $full_file;
            self::resizeImage($full_file, 'news', 'small');
        }
        Image::load(public_path('storage') . '/' . $request->type . '/' . $full_file)->optimize()->save(public_path('storage') . '/' . $request->type . '/' . $full_file);

        return $name;
    }

    private static function resizeImage($image, $type, $size)
    {
        if ($size == 'small') {
            Image::load(public_path('storage') . '/' . $type . '/' . $image)->width(250)->height(250)->save(public_path('storage') . '/' . $type . '/thumb_' . $image);
        } else if ($size == 'medium') {
            Image::load(public_path('storage') . '/' . $type . '/' . $image)->width(500)->height(500)->save(public_path('storage') . '/' . $type . '/thumb_' . $image);
        }
    }
}
