<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ProviderController extends Controller
{
    public function index() {
        $providers = Provider::all();

        return view('providers.index', compact('providers'));
    }

    public function create() {
        return view('providers.create');
    }

    public function store(Request $request) {

        $request->validate([
            'nombre_prov' => 'required|string|max:60',
            'email_prov' => 'required|unique:providers,nombre_prov|max:60',
            'direccion_prov' => 'required|string|max:100',
            'telefono_prov' => 'required|max:40',
        ]);

        $provider = Provider::create($request->all());
        
        return redirect()->route('providers.index');
    }

    public function show() {
        
    }

    public function edit($id) {
        $provider = Provider::find($id);

        return view('providers.edit', compact('provider'));
    }

    public function update(Request $request, Provider $provider) {

        $messages = [
            'nombre_prov.required' => 'El nombre es requerido.',
            'email_prov.unique' => 'El email ya existe.',
            'email_prov.required' => 'El email es requerido.',
            'direccion_prov.required' => 'La direccion es requerida.',
            'telefono_prov.required' => 'El telefono es requerido.',
            'telefono_prov.max' => 'El numero de telefono es invalido.',
        ];

        Validator::make($request->all(), [
            'email_prov' => [
                'required',
                Rule::unique('providers')->ignore($provider->id),
                'max:60'
            ],
            'nombre_prov' => 'required|string|max:60',
            'direccion_prov' => 'required|string|max:100',
            'telefono_prov' => 'required|max:20',
        ], $messages)->validate();

        try {
            $provider->update($request->all());
            return redirect()->route('providers.index');
        } catch (QueryException $exception) {
            return back()->withErrors('No se pudo editar el proveedor. Por favor comuniquese con el administrador.')->withInput();
        }
        
    }

    public function destroy($id) {
        $provider = Provider::find($id);
        $provider->delete();
        // return redirect()->route('providers.index');
        return 'exito';
    }
}
