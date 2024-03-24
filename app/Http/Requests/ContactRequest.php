<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'max:255', 'email'],
            'message' => ['required', 'string']
        ];
    }

    public function messages()
    {
        return [
            /*'eye_color.in' => 'Wrong eye color.',
            'hair_color.in' => 'Wrong hair color.',
            'playing_range.in' => 'Wrong Playing range selected.',
            'etnicity_id.exists' => 'Wrong Etnicity selected.',
            'languages.*' => 'Wrong Language selected.'*/
        ];
    }
}
