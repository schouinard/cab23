<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndisponibiliteRequest extends FormRequest
{
    protected $redirect;

    public function __construct(
        array $query = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        $content = null
    ) {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->redirect = \URL::previous().'#disponibilites';
    }

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
            'from' => 'required',
            'to' => 'required|after:from',
        ];
    }
}
