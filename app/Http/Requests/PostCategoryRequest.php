<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostCategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'post_id' => ['required', 'numeric', 'exists:posts,id'],
            'category_id' => [
                'required',
                'numeric', 'exists:categories,id',
                Rule::unique('category_post', 'category_id')
                    ->where('post_id', $this->input('post_id'))
            ],
        ];
    }
}
