<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index(Request $request)
    {
        return File::paginate(20);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required',
            'title' => 'required',
            'type' => 'required',
            'date_time' => 'required'
        ]);

        $item = File::create($request->all());
        return ['success' => true, 'id' => $item->id];
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'file' => 'required',
            'title' => 'required',
            'type' => 'required',
            'date_time' => 'required'
        ]);

        File::find($id)->update($request->all());
        return ['success' => true];
    }

    public function item($id)
    {
        return File::find($id);
    }
}
