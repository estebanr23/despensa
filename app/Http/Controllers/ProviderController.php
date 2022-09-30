<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Provider;
use Illuminate\Http\Request;

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
        
        $request->validate([
            'nombre_prov' => 'required|string|max:60',
            'direccion_prov' => 'required|string|max:100',
            'telefono_prov' => 'required|max:40',
        ]);

        Validator::make($request->all(), [
            'email_prov' => [
                'required',
                Rule::unique('providers')->ignore($request->email_prov),
                'max:60'
            ],
        ]);

        $provider->update($request->all());

        return redirect()->route('providers.index');
    }

    public function destroy($id) {
        $provider = Provider::find($id);
        $provider->delete();
        return redirect()->route('providers.index');
    }
}
