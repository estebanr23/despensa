<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create() {
        return view('users.create');
    }

    public function store(Request $request) {

        $request->validate([
            "name" => "required",
            "user" => "required|unique:users,user",
            "password" => "required",
        ]);

        $user = User::create([
            "name" => $request->name,
            "user" => $request->user,
            "password" => Hash::make($request->password),
        ]);

        return redirect()->route('users.index');
    }

    public function edit() {
        
    }

    public function update() {
        
    }

    public function show() {
        
    }

    public function destroy($id) {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}
