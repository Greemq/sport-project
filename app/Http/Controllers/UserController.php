<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        return User::paginate(20);
    }

    public function item($id)
    {
        return User::find($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'region' => 'required',
            'role_id' => 'required'
        ]);

        $request['password'] = Str::random(6);
        $arr = array_merge($request->all());
        $item = User::create($arr);
        return ['success' => true, 'id' => $item->id];
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'region' => 'required',
            'role_id' => 'required'
        ]);
        User::find($id)->update($request->all());
        return ['success' => true];
    }
}
