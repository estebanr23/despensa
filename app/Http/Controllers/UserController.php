<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
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
        $messages = [
            'name.required' => 'El nombre es requerido.',
            'user.required' => 'El usuario es requerido.',
            'user.unique' => 'El usuario ya existe.',
            'password.required' => 'La contraseña es requerida.',
        ];

        $request->validate([
            "name" => "required",
            "user" => "required|unique:users,user",
            "password" => "required",
        ], $messages);

        try {
            $user = User::create([
                "name" => $request->name,
                "user" => $request->user,
                "password" => Hash::make($request->password),
            ]);

            return redirect()->route('users.index');

        } catch (QueryException $exception) {
            return back()->withErrors('No se pudo crear el usuario. Por favor comuniquese con el administrador.')->withInput();
        }

    }

    public function edit($id) {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user) {

        $messages = [
            'name.required' => 'El nombre es requerido.',
            'user.required' => 'El usuario es requerido.',
            'user.unique' => 'El usuario ya existe.',
            'password.required' => 'La contraseña es requerida.',
        ];

        $request->validate([
            "name" => "required",
            "user" => "required|unique:users,user,".$user->id,
            "password" => "required",
        ], $messages);

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
