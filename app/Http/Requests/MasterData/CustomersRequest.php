<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Foundation\Http\FormRequest;

class CustomersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|digits_between:10,15',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:500',
            'status' => 'required|in:0,1',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'phone.numeric' => 'Nomor telepon hanya boleh berisi angka.',
            'phone.digits_between' => 'Nomor telepon harus antara 10-15 digit.',
            'email.email' => 'Format email tidak valid.',
            'status.in' => 'Status harus Active atau Inactive.',
        ];
    }
}
