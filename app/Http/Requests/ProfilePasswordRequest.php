<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ProfilePasswordRequest extends FormRequest
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
            'current_pass_input' => 'required',
            'new_pass_input' => 'min:6|required_with:confirm_pass_input|same:confirm_pass_input',
            'confirm_pass_input' => 'min:6'
        ];
    }

    public function withValidator($validator)
    {
        // checks user current password
        // before making changes
        $validator->after(function ($validator) {
            if ( !Hash::check($this->current_pass_input, auth('admin')->user()->password) ) {
                $validator->errors()->add('current_pass_input', __('admin\general.current_pass_validate'));
            }
        });
        return;
    }

    public function messages()
    {
        return [
            'required' => __('admin\general.required_validate'),
            'same' => __('admin\general.same_validate'),
            'min' => __('admin\general.min_validate').':min',
        ];
    }
}
