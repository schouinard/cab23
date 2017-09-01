<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddClientRequest extends FormRequest
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
            'beneficiaire_id' => [
                'required',
                //Rule::exists('beneficiaires', 'id')->where(function ($query) {
                //    $query->whereNull('tournee_id');
                //}),
            ],
        ];
    }

    public function messages()
    {
        return [
            'beneficiaire_id.exists' => 'Le bénéficiaire est déjà client d\'une tournée.',
        ];
    }
}
