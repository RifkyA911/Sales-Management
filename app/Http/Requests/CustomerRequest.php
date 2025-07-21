<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{

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
        $rules = [
            'Nama_Customer' => 'required|string|max:255'
        ];

        // Khusus untuk membuat (POST), Kode_Customer harus unik dan ada
        if ($this->isMethod('post')) {
            $rules['Kode_Customer'] = 'required|string|size:4|unique:T_Customer,Kode_Customer';
        }

        // Khusus untuk update (PUT/PATCH), Kode_Customer tidak perlu diubah, tapi bisa divalidasi exist
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['Kode_Customer'] = 'required|string|size:4|exists:T_Customer,Kode_Customer';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'Kode_Customer.required' => 'Kode Customer wajib diisi.',
            'Kode_Customer.string' => 'Kode Customer harus berupa teks.',
            'Kode_Customer.size' => 'Kode Customer harus 4 karakter.',
            'Kode_Customer.unique' => 'Kode Customer sudah ada.',
            'Kode_Customer.exists' => 'Kode Customer tidak ditemukan.',
            'Nama_Customer.required' => 'Nama Customer wajib diisi.',
            'Nama_Customer.string' => 'Nama Customer harus berupa teks.',
            'Nama_Customer.max' => 'Nama Customer maksimal 40 karakter.',
        ];
    }
}
