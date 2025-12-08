<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required',
            'brand_id' => 'required',
            'product_name' => 'required|string',
            'selling_price' => 'required',
            'short_desc' => 'required',
            'photo' => 'required|image',
            'product_quantity' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => "Category is required",
            'brand_id.required' => "Brand is required",
            'selling_price.required' => "Product Price is required",
            'short_desc' => "Short Description is required",
            'photo.required' => "Product Image is required",
            'product_quantity.required' => "Product  quantity is required"
        ];
    }
}
