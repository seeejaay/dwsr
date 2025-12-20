<?php

namespace App\Http\Requests\ProductRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class ProductRequest extends FormRequest
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
        // $siteId = $this->route('site`');
        $isUpdate = $this->isMethod('put') || $this->isMethod('patch');
        $required = $isUpdate ? 'sometimes' : 'required';
        return [
            //
            // 'ship_to' => "{$required}|string|regex:/^[0-9]+$/",
            // 'arnoc' => "{$required}|string|regex:/^[0-9]+$/",
            // 'cluster_id' => "{$required}|uuid|exists:clusters,id",
            'product_name' => "{$required}|string|unique:products,product_name|regex:/^[a-zA-Z\s]+$/",
            'product_type_id'=> "{$required}|uuid|exists:product_types,id",
            'product_category_id'=> "{$required}|uuid|exists:product_categories,id",
            // 'type'=> "{$required}|string|regex:/^[a-zA-Z\s]+$/",
            // 'zone_id'=> "{$required}|uuid|exists:zones,id",

            // 'retailer_owner_id'=> "{$required}|uuid|exists:retailers,id",
            // 'code' => "{$required}|string|unique:sites,code|regex:/^[A-Z0-9_]+$/",
            // 'description'=> "{$required}|nullable|string|max:255",
            // 'slug'=> "{$required}|string|regex:/^[a-zA-Z\s]+$/",
            // 'view'=> "{$required}|string|regex:/^[a-zA-Z\s]+$/",
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
