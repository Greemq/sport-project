<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function newsList(Request $request)
    {
        return News::paginate(10);
    }
}
