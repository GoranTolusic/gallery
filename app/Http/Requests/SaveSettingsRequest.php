<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveSettingsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:4048'],
            'background_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:4048'],
            'title' => ['required', 'string', 'max:255'],
            'style' => ['in:dark_mode,normal'],
            'contact_phone' => ['nullable', 'max:255', 'string'],
            'contact_address' => ['nullable', 'max:255', 'string'],
            'contact_email' => ['nullable', 'max:255', 'string'],
            'contact_name' => ['nullable', 'max:255', 'string'],
            'contact_instagram' => ['nullable', 'max:255', 'string'],
            'contact_facebook' => ['nullable', 'max:255', 'string'],
            'quote' => ['nullable', 'max:255', 'string'],
            'about' => ['nullable', 'string']
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
