<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'nombre' => ['required', 'max:255'],
            'apellido' => ['required', 'max:255'],
            'domicilio'=>['required', 'max:255'],
            'telefono'=>['required', 'max:255'],
           
        ];
        if ($this->getMethod() == 'POST') {
            $rules += ['email' => ['required', 'unique:usuarios']];
        }

        return $rules;
    }

    /**@
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es requerido',
            'nombre.max' => 'No debe contener mas de 255 caracteres',
            'apellido.required' => 'El apellido es requerido',
            'apellido.max' => 'No debe contener mas de 255 caracteres',
            'domicilio.required'=> 'El domicilio es requerido',
            'domicilio.max' => 'No debe contener mas de 255 caracteres',
            'telefono.required'=>'El teléfono es requerido',
            'telefono.max' => 'No debe conetener mas de 255 carateres',

            'email.required' => 'El correo es requerido',
            'email.unique' => 'El correo ya esta registrado en la base',
            
        ];
    }
}
