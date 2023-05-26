<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'icon' => 'sometimes|nullable|string|max:200',
            'name.*' => 'min:3|string',
            'slug.*' => 'min:3|string',
            'category_id' => 'sometimes|nullable|exists:categories,id'

        ];
    }
}
