<?php

namespace App\Http\Controllers;

use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'is_published' => 'required',
            'img' => 'required',

        ]);
        $arr = array_merge($request->all(), ['publish_date' => Carbon::now()->toDateTimeString(),'user_id'=>Auth::id()]);
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
