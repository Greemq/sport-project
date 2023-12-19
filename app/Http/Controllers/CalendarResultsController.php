<?php

namespace App\Http\Controllers;

use App\Models\CalendarResults;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CalendarResultsController extends Controller
{
    public function index(Request $request)
    {
        return CalendarResults::withCount('athlete')->paginate('20');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_time' => 'required',
            'title' => 'required',
            'state' => 'nullable',
            'protocol' => 'nullable',
            'status' => 'required',
            'link' => 'nullable',
            'type' => 'required'
        ]);

        $item = CalendarResults::create($request->all());


        return ['id' => $item->id, 'success' => true];
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date_time' => 'required',
            'title' => 'required',
            'state' => 'nullable',
            'protocol' => 'nullable',
            'status' => 'required',
            'link' => 'nullable',
            'type' => 'required'
        ]);

        CalendarResults::find($id)->update($request->all());

        return ['success' => true];
    }

    public function item($id)
    {
        return CalendarResults::find($id);
    }


}
