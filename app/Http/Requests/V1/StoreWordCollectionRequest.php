<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreWordCollectionRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'text' => ['required', 'string'],
            'status' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!in_array($value, ['private', 'pending'])) {
                    $fail('The ' . $attribute . ' is invalid.');
                }
            }],
        ];
    }
}
