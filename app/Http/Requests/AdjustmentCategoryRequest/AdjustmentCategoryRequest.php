<?php

namespace App\Http\Requests\AdjustmentCategoryRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class AdjustmentCategoryRequest extends FormRequest
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
        // $pumpId = $this->route('pump');
        $isUpdate = $this->isMethod('put') || $this->isMethod('patch');
        $required = $isUpdate ? 'sometimes' : 'required';
        return [
            //
            'name' => "{$required}|string|unique:adjustment_categories,name|regex:/^[a-zA-Z0-9\-\s]+$/",
            // 'code' => "{$required}|string|unique:adjustment_categories,code|regex:/^[A-Z0-9_]+$/",
           'description'=> "{$required}|nullable|string|max:255|regex:/^[\pL\pN\s\.,;:!?\"'()\[\]\-\/_@#&%$*]+$/u",
           'type' => "{$required}|in:Positive,Negative",
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
