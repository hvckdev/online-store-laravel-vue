<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'string|required|max:256',
            'description' => 'string|required|max:4096',
            'photo' => 'mimes:jpg,jpeg,png|max:1024|nullable',
            'in_stock' => 'integer|required'
        ];
    }
}
