<?php

namespace App\Http\Requests\UserRequest;

use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class UserRequest extends FormRequest
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
        $userId = $this->route('user');
        $isUpdate = $this->isMethod('put') || $this->isMethod('patch');
        $required = $isUpdate ? 'sometimes' : 'required';
        return [
            //

            'user_name' => "{$required}|string|unique:users,user_name|regex:/^[a-zA-Z0-9_]+$/",
            'first_name'=> "{$required}|string|max:50|regex:/^[a-zA-Z]+$/",
            'middle_name'=> "{$required}|nullable|string|max:50|regex:/^[a-zA-Z]+$/",
            'last_name'=> "{$required}|string|max:50|regex:/^[a-zA-Z]+$/",
            'salutation'=> "{$required}|string|in:Mr,Mrs,Ms,Mx",
            'email' => [
                $required,
                'email',
                Rule::unique('users', 'email')->ignore($isUpdate ? $userId : null)
            ],
            'password' => $isUpdate ? 'sometimes|nullable|string|min:8|confirmed' : 'required|string|min:8|confirmed',
            'role_id' => "{$required}|exists:roles,id",
        ];
    }
    
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422)
        );
    }
}
