<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class StorePostsRequest extends FormRequest
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
            'title' => 'required|string|max:225',
            'description' => 'required|string',
            'body' => 'required|string',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'publish' => 'boolean',
            'user_id' => 'exists:users,id',
            'post_category_id' => 'required|exists:post_categories,id'
        ];
    }
}
