<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlumnoRequest extends FormRequest
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

    public function prepareForValidation(){
        if($this->nombre!=null){
            $this->merge([
                'nombre'=> ucwords($this->nombre)
            ]);
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
            'nombre' => ['required'],
            'apellidos' => ['required'],
            'mail' => ['required', 'unique:alumnos,mail', "email:rfc,dns"],
            'logo' => ['nullable', 'image']
        ];
    }
    /**
     * Get messages of validation failure
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nombre.required' => "El Campo Nombre es Obligatorio",
            'apellidos.required' => "El Campo Apellidos es Obligatorio",
            'mail.required' => "El Campo Mail es Obligatorio",
            'mail.unique' => "Ya existe ese mail en el sistema",
            'logo.unique' => "El fichero debe ser de tipo imagen"
        ];
    }
}
