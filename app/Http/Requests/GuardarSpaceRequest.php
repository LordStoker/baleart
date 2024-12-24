<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarSpaceRequest extends FormRequest
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
            'comment' => 'require|string|max:2000',
            'score' => 'require|integer|min:1|max:5',
            'status' => 'require|string|max:1|in:y,n',
            'user_id' => 'require|integer',
            'url' => 'require|string|max:100',
        ];
    }
}
