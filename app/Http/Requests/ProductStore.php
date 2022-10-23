<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'codigo' => 'required|unique:products,codigo|max:10',
            'nombre_prod' => 'required|string|unique:products,nombre_prod|max:60',
            'precio_prod' => 'required|numeric',
            'stock_prod' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'codigo.required' => 'El codigo es requerido',
            'codigo.unique' => 'El codigo debe ser unico',
            'nombre_prod.required' => 'El nombre es requerido',
            'nombre_prod.unique' => 'El nombre del producto debe ser unico',
            'precio_prod.required' => 'El precio es requerido',
            'stock_prod.required' => 'La cantidad es requerida',
        ];
    }
}
