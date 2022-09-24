<?php

namespace App\Http\Requests\Api;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => ['required', 'string', 'max:12','min:6','unique:users,username','alpha_dash'],
            'email'    => ['required','email','max:40'],
            'password' => ['required','min:8','max:15']
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
