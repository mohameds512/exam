<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class storeUsersRequest extends FormRequest
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
        $rules = [
            'name' => 'required|max:255',
            'role' => 'required',
        ];

        if ($this->getMethod() == "POST") {
            $rules += [
                'email' => 'required|unique:users,email',
                'phoneNumber' => 'required|numeric|digits:11|unique:users',
                'password' => 'required|confirmed',
            ];

        }

        if ($this->getMethod() == "patch") {
            $rules += [
                'email' => [
                    'required',
                    Rule::unique('users')->ignore($this->id),
                ],
                'phoneNumber' => 'required|numeric|digits:11|unique:users,phoneNumber,'.$this->id,
            ];
        }

        return $rules;
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
            'phoneNumber.digits' => trans('validation.digits') . '11',
            'phoneNumber.unique' => trans('validation.unique'),
            'role.required' => trans('validation.required'),
        ];


    }
}

