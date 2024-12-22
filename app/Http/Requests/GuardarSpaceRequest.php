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
            'comment' => 'sometimes|string|max:2000',
            'score' => 'sometimes|integer|min:1|max:5',
            'status' => 'sometimes|string|max:1|in:y,n',
            'user_id' => 'sometimes|integer',
            'url' => 'sometimes|string|max:100',
        ];
    }
}
