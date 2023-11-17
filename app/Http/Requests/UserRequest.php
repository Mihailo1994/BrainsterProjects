<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
       ];
    }

    public function messages(): array
    {
    return [
        'firstname.required' => 'Полето за име  е задолжително',
        'lastname.required' => 'Полето за презиме е задолжително',
        'email.required' => 'Полето за email е задолжително',
        'password.required' => 'Полето за пасворд е задолжително',
        'email.unique' => 'Постои акаунт со внесениот емаил',
        'email.email' => 'Внесовте не важечка емаил адреса',
    ];
    }
}
