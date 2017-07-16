<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'string|required|min:2',
            'surname' => 'string|required',
            'email' => 'email|required',
            'code' => 'string|required',
            'city' => 'string|required',
            'country' => 'string|required',
            'address' => 'string|required',
        ];
    }
}
