<?php

namespace App\Http\Requests\RoleRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class RoleRequest extends FormRequest
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
        // $roleId = $this->route('role');
        $isUpdate = $this->isMethod('put') || $this->isMethod('patch');
        $required = $isUpdate ? 'sometimes' : 'required';
        return [
            //
            'name' => "{$required}|string|unique:roles,name|regex:/^[a-zA-Z0-9\-\s]+$/",
            // 'code' => "{$required}|string|unique:roles,code|regex:/^[A-Z0-9_]+$/",
            'description'=> "{$required}|nullable|string|max:255",
            'slug'=> "{$required}|string|regex:/^[a-zA-Z\s]+$/",
            'view'=> "{$required}|string|regex:/^[a-zA-Z\s]+$/",
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
