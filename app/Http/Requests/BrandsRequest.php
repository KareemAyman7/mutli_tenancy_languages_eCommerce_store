<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandsRequest extends FormRequest
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
        $rules =  [
            'name' => 'required|string',
            'photo' => 'required_without:id|mimes:jpg,jpeg,png',
        ];

        return $rules;

    }

    public function messages()
    {
        return [
            'required' => __('admin\general.required_validate'),
            'mimes' => __('admin\general.mimes_photo_validate'),
        ];
    }
}
