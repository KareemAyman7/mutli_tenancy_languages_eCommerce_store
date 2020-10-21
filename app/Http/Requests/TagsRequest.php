<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagsRequest extends FormRequest
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
            'slug' => 'required|unique:tags,slug,'.$this->id,
        ];

        if ($this->getMethod() == 'POST') {
            $rules['slug'] = 'required|unique:tags,slug';
        }

        return $rules;

    }

    public function messages()
    {
        return [
            'required' => __('admin\general.required_validate'),
            'unique' => __('admin\general.unique_validate'),
        ];
    }
}
