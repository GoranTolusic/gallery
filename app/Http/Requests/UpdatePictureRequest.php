<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePictureRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'main_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'order' => ['numeric', 'required', 'max:999999']
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
