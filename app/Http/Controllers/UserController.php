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

    public function edit($id) {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user) {
        if($request->password) {
            $user->name = $request->name;
            $user->user = $request->user;
            $user->password = Hash::make($request->password);
            $user->save();
        } else {
            $user->name = $request->name;
            $user->user = $request->user;
            $user->save();
        }

        return redirect()->route('users.index');
    }

    public function show() {
        
    }

    public function destroy($id) {
        $user = User::find($id);
        $user->delete();
        return 'exito';
    }
}
