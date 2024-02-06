<?php

namespace App\Http\Requests\APIs;

use App\Helpers\ResponseFormatter;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException( 
                ResponseFormatter::error([
                'message' => 'Bad Request Data',
                'error' => $validator->errors(),
            ], $validator->errors()->first(), 400)
        );
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email' => 'The email is not valid.',
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah terdaftar',
            'max' => ':attribute tidak boleh lebih dari :max karakter',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'email' => 'Email address',
            'name' => 'Name',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array<string, string>
     */
    public function validationData(): array
    {
        return array_merge($this->all(), [
            'email' => strtolower($this->input('email')),
        ]);
    }
}
