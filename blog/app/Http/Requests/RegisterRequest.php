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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nick' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|max:255',
            'password' => 'required|string|min:6|confirmed'
        ];
    }
    
    public function messages()
    {
        return [
            'nick.required' => "Обязательное поле",
            'nick.max' => "Максимальное кол-во символов - 255",
            'name.max' => "Максимальное кол-во символов - 255",
            'email.max' => "Максимальное кол-во символов - 255",
            'phone.max' => "Максимальное кол-во символов - 255",
            'password.min' => "Минимально кол-во символов - 6",
            'name.required' => "Обязательное поле",
            'email.required'  => "Обязательное поле",
            'email.unique'  => "Пользователь с этой почтой уже существует",
            'phone.required'  => "Обязательное поле",
            'password.required'  => "Обязательное поле",
        ];
    }
}
