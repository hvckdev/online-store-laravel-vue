<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'string|max:256',
            'category_id' => 'integer',
            'description' => 'string|max:4096',
            'photo' => 'image|mimes:jpg,jpeg,png|max:1024|nullable',
            'in_stock' => 'integer'
        ];
    }
}
