<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoriesRequest extends FormRequest
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
            'slug' => 'required|unique:categories,slug,'.$this->id,
        ];

        if ($this->getMethod() == 'POST') {
            //$rules += ['password' => 'required|min:6'];
            $rules['slug'] = 'required|unique:categories,slug';
        }

        return $rules;

    }

    public function messages()
    {
        return [
            'required' => __('admin\general.required_validate'),
            'numeric' => __('admin\general.numeric_validate'),
            'unique' => __('admin\general.unique_validate'),
        ];
    }
}
