<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:App\Models\Client,email',
            'avatar' => 'required|image|mimes:jpeg,jpg,png|max:2048|dimensions:min_width=100,min_height=100',
        ];
    }

    public function messages(): array
    {
        return [
            'dimensions' => 'Avatar size is minimum 100x100 pixels'
        ];
    }
}
