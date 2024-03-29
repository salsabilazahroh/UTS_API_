<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool // Authorization check
    {
        return $this->user() != null;
    }

    public function rules(): array // Validation rules
    {
        return [
            'name' => ['nullable', 'max:100'],
            'password' => ['nullable', 'max:100']
        ];
    }

    protected function failedValidation(Validator $validator) // Handle failed validation
    {
        throw new HttpResponseException(response([
            "errors" => $validator->getMessageBag()
        ], 400));
    }
}
