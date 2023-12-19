<?php

namespace App\Http\Controllers;

use App\Models\CalendarResults;
use App\Models\File;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return ['success' => true, 'token' => $user->createToken('sport-client-token')->accessToken];
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => 2])) {
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
        return CalendarResults::filter($request->all())->order($request->all())->paginate($request->pagination);

    }

    public function userInfo()
    {
        return Auth::user();
    }

    public function getFiles(Request $request)
    {
        return File::filter($request->all())->get();
    }
}
