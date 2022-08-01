<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class registerRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phoneNumber'  => ['required','numeric','digits:11','unique:users'],
            'role' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validation.required'),
            'name.max' => trans('validation.max'),
            'email.required' => trans('validation.required'),
            'email.unique' => trans('validation.unique'),
            'password.required' => trans('validation.required'),
            'password.confirmed' => trans('validation.confirmed'),
            'phoneNumber.required' => trans('validation.required'),
            'phoneNumber.numeric' => trans('validation.numeric'),
            'phoneNumber.digits' => trans('validation.digits'),
            'phoneNumber.unique' => trans('validation.unique'),
            'role.required' => trans('validation.required'),
        ];
    }

}

