<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255|unique:customers,email,' . $this->route('customer')->id,
            'status' => 'required|in:0,1',
        ];
    }
}