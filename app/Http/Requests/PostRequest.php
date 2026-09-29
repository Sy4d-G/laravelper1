<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $postId = $this->route('post') ? ($this->route('post') instanceof \App\Models\Post ? $this->route('post')->id : $this->route('post')) : null;

        if ($this->isMethod('post')) {
            return [
                'title' => 'required|string|max:255|unique:posts,title',
                'body' => 'required|string',
                'user_id' => 'nullable|exists:users,id',
            ];
        }

        return [
            'title' => 'sometimes|required|string|max:255|unique:posts,title,' . $postId,
            'body' => 'sometimes|required|string',
            'user_id' => 'nullable|exists:users,id',
        ];
    }
}
