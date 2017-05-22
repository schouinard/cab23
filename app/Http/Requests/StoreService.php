<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreService extends FormRequest
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
            'service_type_id' => 'bail|required|exists:service_types,id',
            'serviceable_type' => 'bail|required',
            'organisme_id' => 'required_without:beneficiaire_id|exists:organismes,id',
            'beneficiaire_id' => 'required_without:organisme_id|exists:beneficiaires,id',
            'rendu_le' => 'date',
            'benevole_id' => 'bail|required|exists:benevoles,id',
            'don' => 'nullable|numeric',
            'heures' => 'nullable|numeric',
        ];
    }
}
