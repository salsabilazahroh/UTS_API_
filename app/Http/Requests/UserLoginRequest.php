<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserLoginRequest extends FormRequest
{
    public function authorize(): bool // Authorization check
    {
        return true;
    }

    public function rules(): array // Validation rules
    {
        return [
            'username' => ['required', 'max:100'],
            'password' => ['required', 'max:100'],
        ];
    }

    protected function failedValidation(Validator $validator) // Handle failed validation
    {
        throw new HttpResponseException(response([
            "errors" => $validator->getMessageBag()
        ], 400));
    }
}
