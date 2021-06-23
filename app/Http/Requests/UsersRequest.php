<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            'name'=>'required|string|between:2,100',
            'username'=>'required|email|unique:users',
            'author_pseudonym'=>'required|string|between:2,100',
            'password'=>'required|confirmed|min:6'
        ];
    }
}
