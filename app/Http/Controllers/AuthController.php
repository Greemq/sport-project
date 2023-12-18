<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('admin-sport-token');
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
                    'errors' => ['user' => ['Incorrect phone number or password']]
                ]], 401);
        }
    }

    public function logout()
    {
        Auth::user()->token()->revoke();

        return response()->json(['success' => true, 'message' => 'Successfully logged out']);
    }

    public function userInfo()
    {
        return Auth::user();
    }
}
