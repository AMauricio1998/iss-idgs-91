<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function messages(){
        return[
            'nombre.required' => 'El nombre es requerido',
            'codigo_producto.required' => 'Este campo es requerido',
            'descripcion.required' => 'Este campo es requerido',
            'stock.required' => 'Este campo es requerido',
            'id_unidad.required' => 'Elige una unidad',
            'id_categoria.required' => 'Elige una categoria',
        ];
    }

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'codigo_producto' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string', 'max:255'],
            'stock' => ['required' , 'max:10'],
            'id_unidad' => ['required' , 'max:10'],
            'id_categoria' => ['required' , 'max:10'],
            'activo' => 'required'
        ];
    }
}
