<?php

namespace App\Http\Controllers;

use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        return News::paginate(20);
    }

    public function item($id)
    {
        return News::find($id);
    }

    public function store(Request $request)
    {
        Log::error($request->all());
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'is_published' => 'required',
            'img' => 'required',
            'publish_date' => 'required'

        ]);

        $arr = array_merge($request->all(), ['user_id' => Auth::id()]);
        $item = News::create($arr);
        return ['success' => true, 'id' => $item->id];
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'is_published' => 'required',
            'img' => 'required'
        ]);
        News::find($id)->update($request->all());
        return ['success' => true];
    }
}
