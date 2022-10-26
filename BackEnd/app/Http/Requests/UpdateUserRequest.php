<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255|min:6',
            'phone' => 'required|min:10|max:15',
            'email' => 'required|email',
            'address' => 'required',
            'province_id' => 'required',
            'district_id' => 'required',
            'ward_id' => 'required',


        ];
    }
    public function messages()
    {
        return [
            'province_id.required' => 'The province field is required.',
            'district_id.required' => 'The district field is required.',
            'ward_id.required' => 'The ward field is required.',
        ];
    }
}
