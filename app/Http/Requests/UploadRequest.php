<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
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
            'section_id' => 'required',
            'photos' => 'required'
        ];
        
        $photos = count($this->input('photos'));
        foreach(range(0, $photos) as $index) {
            $rules['photos.'.$index] = 'image|mimes:jpeg,bmp,png|max:2000';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'section_id.required' => 'An album is required',
        ];
    }    
}
