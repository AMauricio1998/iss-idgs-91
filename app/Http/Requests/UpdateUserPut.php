<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules;

class UpdateUserPut extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function messages(){
        return[
            'name.required' => 'El nombre es requerido',
            'app.required' => 'Este campo es requerido',
            'apm.required' => 'Este campo es requerido',
            'telefono.required' => 'Este campo es requerido',
            'colonia.required' => 'Este campo es requerido',
            'calle.required' => 'Este campo es requerido',
            'cod_postal.required' => 'Este campo es requerido',
            'num_calle.required' => 'Este campo es requerido',
            'estado.required' => 'Este campo es requerido',
            'municipio.required' => 'Este campo es requerido',
            'email.required' => 'Este campo es requerido',
            'id_area.required' => 'Este campo es requerido',
            'id_rol.required' => 'Este campo es requerido',
        ];
    }
    
    public function authorize()
    {
        return true;
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator) {
        if ($this->expectsJson()) {
            $response = new Response($validator->errors(), 400);
            throw new ValidationException($validator, $response);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'app' => ['required', 'string', 'max:255'],
            'apm' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'max:15'],
            'colonia' => ['required', 'string', 'max:255'],
            'calle' => ['required', 'string', 'max:255'],
            'cod_postal' => ['required', 'string', 'max:5'],
            'num_calle' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'max:255'],
            'municipio' => ['required', 'string', 'max:255'],
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users'.$this->route('id'),
            'id_area' => ['required'],
            'id_rol' => ['required'],
            'status' => ['required']
        ];
    }
}
