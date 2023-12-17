<?php

namespace App\Http\Controllers;

use App\Models\CalendarResults;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PublicController extends Controller
{
    public function newsList(Request $request)
    {
        return News::paginate(10);
    }

    public function getResults(Request $request){
        Log::error($request->all());
        return CalendarResults::filter($request->all())->paginate($request->pagination);

    }
}
