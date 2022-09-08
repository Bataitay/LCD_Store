<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerStoreRequest extends FormRequest
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
    public function rules() {
        return [
            'path' => 'required|min:3',
            'banner' => 'required',
        ];
    }
    function attributes() {
        return [
            'path' => 'Url',
            'banner' => 'Banner'
        ];
    }
}
