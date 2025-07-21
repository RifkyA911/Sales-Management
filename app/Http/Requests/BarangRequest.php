<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'Nama_Barang' => 'required|string|max:20|min:3',
            'Harga_Barang' => 'required|numeric|min:0',
        ];

        if ($this->isMethod('post')) {
            $rules['Kode_Barang'] = 'required|string|size:10|unique:T_Barang,Kode_Barang';
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['Kode_Barang'] = 'required|string|size:10|exists:T_Barang,Kode_Barang';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'Kode_Barang.required' => 'Kode Barang wajib diisi.',
            'Kode_Barang.string' => 'Kode Barang harus berupa teks.',
            'Kode_Barang.size' => 'Kode Barang harus 10 karakter.',
            'Kode_Barang.unique' => 'Kode Barang sudah ada.',
            'Nama_Barang.required' => 'Nama Barang wajib diisi.',
            'Nama_Barang.string' => 'Nama Barang harus berupa teks.',
            'Nama_Barang.max' => 'Nama Barang maksimal 20 karakter.',
            'Nama_Barang.min' => 'Nama Barang minimal 3 karakter.',
            'Harga_Barang.required' => 'Harga Barang wajib diisi.',
            'Harga_Barang.numeric' => 'Harga Barang harus berupa angka.',
            'Harga_Barang.min' => 'Harga Barang tidak boleh kurang dari 0.',
        ];
    }
}
