<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\AthleteCalendarResult;
use App\Models\CalendarResults;
use App\Models\File;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PublicController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'region' => 'required',
            'role_id' => 'required'
        ]);

        $user = User::create($request->all());

        return ['success' => true, 'token' => $user->createToken('sport-client-token')->accessToken, 'user' => $user];
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('sport-token');
            return response()->json([
                'success' => true,
                'data' => [
                    'token' => $token->accessToken,
                    'user' => $user,
                ]], 200);
        } else {
            return response()->json([
                'success' => false,
                'data' => [
                    'errors' => ['email' => 'error', 'password' => 'error']
                ]], 401);
        }
    }

    public function newsList(Request $request)
    {
        return News::paginate(10);
    }

    public function getResults(Request $request)
    {
        return CalendarResults::filter($request->all())->order($request->order)->paginate($request->paginate);

    }

    public function userInfo()
    {
        return Auth::user();
    }

    public function getFiles(Request $request)
    {

        $list = File::filter($request->all())->orderBy('date_time', 'DESC')->get();
        if ($request->type == 2) {
            $list = $list->groupBy(function ($item) {
                return \Carbon\Carbon::parse($item->date_time)->year;
            });
        }
        return $list;
    }

    public function athleteList(Request $request)
    {
        return Athlete::filter($request->all())->orderByDesc('id')->paginate($request->paginate);
    }

    public function applicationAction(Request $request, $id)
    {
        AthleteCalendarResult::find($id)->update(['accepted' => $request->accepted]);
        return ['success' => true];
    }

    public function applicationCreate(Request $request)
    {

        $request->validate([
            'calendar_id' => 'required',
            'id' => 'required'
        ]);

        $athlete = Athlete::find($request->id);

        if (isset($athlete) && !AthleteCalendarResult::where('athlete_id', $request->id)->where('calendar_results_id', $request->calendar_id)->exists()) {
            CalendarResults::find($request->calendar_id)->athlete()->attach($athlete->id);
            return ['success' => true];
        } else {
            return response()->json(
                [
                    'success' => false,
                    'errors' => ['calendar_id' => 'error']
                ], 401
            );
        }

    }

    public function applicationCalendarList()
    {
        return CalendarResults::where('status', 1)->get();
    }

    public function applicationsList(Request $request)
    {
        return AthleteCalendarResult::filter($request->all())->with(['calendarResults', 'athlete'])->paginate($request->paginate);
    }

    public function createAthlete(Request $request)
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
        Athlete::create($request->all());
        return ['success' => true];
    }

    public function setPlace(Request $request)
    {
        $request->validate([
            'place' => 'required',
            'id' => 'required',

        ]);
        AthleteCalendarResult::find($request->id)->update(['place' => $request->place]);
        return ['success' => true];

    }
}
