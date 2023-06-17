<?php

namespace App\Http\Requests;

use App\Http\Enums\ProductStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            // 'images' => 'array',
            // 'images.*' => 'mimes:png,jpg,jpeg',
            'name' => 'array',
            'name.*' => 'min:3',
            'slug' => 'array',
            'slug.*' => 'min:3',
            'long_description' => 'array',
            'long_description.*' => 'min:5|max:250',
            'short_description' => 'array',
            'short_description.*' => 'min:5|max:100',
            'qty' => 'numeric',
            'discount_price' => 'nullable|numeric',
            'selling_price' => 'numeric',
            'sizes' => 'array',
            'sizes.*' => 'exists:sizes,id',
            'colors'=> 'array',
            'color.*' => 'exists:colors,id',
            'code' => 'array',
            'code.*' => 'max:200',
            'tags' => 'array',
            'tags.*' => 'min:3',
            'thumbnail' => 'image|mimes:png,jpg,jpeg',
            'category' => 'exists:categories,id',
            'brand' => 'exists:brands,id',
            // 'status' => 'nullable|in:'. ProductStatusEnum::class
        ];
    }
}
