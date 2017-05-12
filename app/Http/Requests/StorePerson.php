<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePerson extends FormRequest
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
    public function rules()
    {
        return [
            'prenom' => 'required',
            'nom' => 'required',
            'adress.adresse' => 'required',
            'adress.ville' => 'required',
            'adress.province' => 'required',
            'adress.code_postal' => 'required',
        ];
    }
}
