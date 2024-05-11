<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class ChangeCollectionRequest extends FormRequest
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
            'name' => ['string'],
            'text' => ['string'],
            'translation_uk' => ['string'],
            'status' => ['string', function ($attribute, $value, $fail) {
                if (!in_array($value, ['private', 'public'])) {
                    $fail('The ' . $attribute . ' is invalid.');
                }
            }],
        ];
    }

    protected function prepareForValidation()
    {
        if (isset($this->translationUk)) {
            $this->merge(['translation_uk' => $this->translationUk]);
        }
    }
}
