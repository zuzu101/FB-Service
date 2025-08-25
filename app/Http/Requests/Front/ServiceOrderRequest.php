<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class ServiceOrderRequest extends FormRequest
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
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'serial_number' => 'required|string|max:100',
            'reported_issue' => 'required|string|max:1000',
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
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'phone.required' => 'Nomor WhatsApp wajib diisi.',
            'phone.numeric' => 'Nomor WhatsApp hanya boleh berisi angka.',
            'phone.digits_between' => 'Nomor WhatsApp harus antara 10-15 digit.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'address.required' => 'Alamat lengkap wajib diisi.',
            'address.max' => 'Alamat tidak boleh lebih dari 500 karakter.',
            'brand.required' => 'Merk perangkat wajib dipilih.',
            'brand.max' => 'Merk perangkat tidak boleh lebih dari 100 karakter.',
            'model.required' => 'Model/Series wajib diisi.',
            'model.max' => 'Model/Series tidak boleh lebih dari 100 karakter.',
            'serial_number.required' => 'Nomor seri perangkat wajib diisi.',
            'serial_number.max' => 'Nomor seri tidak boleh lebih dari 100 karakter.',
            'reported_issue.required' => 'Keluhan/Kerusakan wajib diisi.',
            'reported_issue.max' => 'Keluhan/Kerusakan tidak boleh lebih dari 1000 karakter.',
        ];
    }
}
