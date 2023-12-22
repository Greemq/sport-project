<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\AthleteCalendarResult;
use Illuminate\Http\Request;

class AthleteController extends Controller
{
    public function index(Request $request)
    {
        return Athlete::paginate(20);
    }

    public function item($id)
    {
        return Athlete::find($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fio' => 'required',
            'location' => 'required',
            'personal_id' => 'required|numeric',
            'category' => 'required',
            'file' => 'required',
            'type' => 'required',
            'class' => 'required',
        ]);
        $item = Athlete::create($request->all());
        return ['success' => true, 'id' => $item->id];
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fio' => 'required',
            'location' => 'required',
            'personal_id' => 'required|numeric',
            'category' => 'required',
            'file' => 'required',
            'type' => 'required',
            'class' => 'required',
        ]);
        Athlete::find($id)->update($request->all());
        return ['success' => true];
    }

    public function applicationsList(Request $request)
    {
        return AthleteCalendarResult::with(['calendarResults', 'athlete'])->paginate(20);
    }


}
