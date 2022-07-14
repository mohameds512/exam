<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeQuestionsRequest extends FormRequest
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
            'question' => 'required',
            'answers' => 'required',
            'right_answer' => 'required',
            'subject_id' => 'required',

        ];
        if ($this->getMethod() == 'post') {
            $rules += [
                'teacher_id' => 'required',
                'Grade_id' => 'required',
                'class_id' => 'required',
                'section_id' => 'required',
            ];
        };
        return $rules ;
        // return [
        //     'teacher_id' => 'required',
        //     'question' => 'required',
        //     'answers' => 'required',
        //     'right_answer' => 'required',
        //     'Grade_id' => 'required',
        //     'class_id' => 'required',
        //     'section_id' => 'required',
        //     'subject_id' => 'required',
        // ];
    }
}
