<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'images' => 'required|array',
            'images.*' => 'required|mimes:png,jpg,jpeg',
            'name' => 'required|array',
            'name.*' => 'required|min:3',
            'slug' => 'required|array',
            'slug.*' => 'required',
            'long_description' => 'required|array',
            'long_description.*' => 'required|min:5|max:250',
            'short_description' => 'required|array',
            'short_description.*' => 'required|min:5|max:100',
            'qty' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'selling_price' => 'required|numeric',
            'sizes' => 'required|array',
            'sizes.*' => 'required|exists:sizes,id',
            'colors'=> 'required|array',
            'color.*' => 'required|exists:colors,id',
            'code' => 'required|array',
            'code.*' => 'required|max:200',
            'tags' => 'required|array',
            'tags.*' => 'required',
            'thumbnail' => 'required|image|mimes:png,jpg,jpeg',
            'category' => 'required|exists:categories,id',
            'brand' => 'required|exists:brands,id',
            // 'status' => 'nullable|in:'. ProductStatusEnum::class
            // 'special_deals' => 'nullable',
            // 'hot_offers' => 'nullable',




        ];
    }
}
