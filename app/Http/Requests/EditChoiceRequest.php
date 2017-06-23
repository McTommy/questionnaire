<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditChoiceRequest extends FormRequest
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
            'questionnaire_id' => 'required',
            'question_order' => 'required',
            'old_order' => 'required',
            'order' => 'required',
            'content' => 'required',
            'jump_to' => 'required',
        ];
    }
}
