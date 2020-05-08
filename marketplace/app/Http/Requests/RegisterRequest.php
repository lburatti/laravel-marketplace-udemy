<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array
     */
    public static $rules = [
        'name' => 'required',
        'cpf' => 'required|min:11|max:14',
        'date_birth' => 'required|min:8|max:10',
        'email' => 'required|email:rfc,dns',
        'password' => 'required|min:8',
        'mobile_phone' => 'required|min:10|max:15',
        'cep' => 'required|min:8|max:9',
        'address' => 'required',
        'number' => 'required',
        'neighborhood' => 'required',
        'city' => 'required',
        'uf' => 'required',
    ];

    public function rules()
    {
        return self::$rules;
    }

    public function messages()
    {
        return [
            'required' => 'Este campo é obrigatório',
            'min' => 'Campo deve ter no mínimo :min caracteres',
            'max' => 'Campo deve ter no mínimo :max caracteres',
            'email' => 'Esse campo deve conter um e-mail válido',
            'password' => 'Esse campo deve conter uma senha válida',
        ];
    }
}
