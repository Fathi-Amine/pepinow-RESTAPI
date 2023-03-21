<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlantRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|max:9|regex:/^(([0-9]*)(\.([0-9]+))?)$/',
            'image'=> 'required|string',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name field must be a string.',
            'name.max' => 'The name field may not be greater than :max characters.',
            'description.required' => 'The description field is required.',
            'description.string' => 'The description field must be a string.',
            'price.required' => 'The price field is required.',
            'price.max' => 'The price field may not be greater than :max characters.',
            'price.regex' => 'The price field must be a valid decimal number with up to two decimal places.',
            'image.required' => 'The image field is required.',
            'image.string' => 'The image field must be a string',
            'categories.required' => 'The categories field is required.',
            'categories.array' => 'The categories field must be an array.',
            'categories.min' => 'The categories field must have at least :min item.',
            'categories.*.exists' => 'The selected category is invalid.',
        ];
    }
}
