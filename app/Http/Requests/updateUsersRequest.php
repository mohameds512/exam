<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class updateUsersRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => [
                'required',
                Rule::unique('users')->ignore($this->id),
            ],
            'phoneNumber' => 'required|numeric|digits:11|unique:users,phoneNumber,'.$this->id,
            'role' => 'required',
        ];


    }



    public function messages()
    {

        if ( App::getLocale() == 'ar') {
            return [
                'name.required' => trans('validation.name_required') ,
                // 'name.required' => 'الأسم مطلوب',
                'name.max' => 'الأسم طويل ',
                'email.required' => 'البريد الألكتروني مطلوب',
                'email.unique' => 'البريد الألكتروني موجود بالفعل',
                'phoneNumber.required' => 'رقم الهاتف مطلوب',
                'phoneNumber.numeric' => 'يجب أن يكون رقم الهاتف ارقام',
                'phoneNumber.digits' => 'يجب أن يكون عدد ارقام الهاتف 11',
                'phoneNumber.unique' => 'رقم الهاتف تم أستخدامه من قبل',
                'role.required' => 'وظيفة المستخدم مطلوبة',
            ];
        } else {
            # code...
        }


    }
}
