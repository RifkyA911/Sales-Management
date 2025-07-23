<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // kalau pakai auth, bisa diubah sesuai kebutuhan
    }

    public function rules(): array
    {
        return [
            'Kode_Tjen' => 'required|string|max:1|unique:T_JEN,Kode_Tjen',
            'Nama_Tjen' => 'required|string|max:10',
        ];
    }

    public function messages(): array
    {
        return [
            'Kode_Tjen.required' => 'Kode Tjen wajib diisi',
            'Kode_Tjen.max' => 'Kode Tjen maksimal 1 karakter',
            'Kode_Tjen.unique' => 'Kode Tjen sudah ada',
            'Nama_Tjen.required' => 'Nama Tjen wajib diisi',
            'Nama_Tjen.max' => 'Nama Tjen maksimal 10 karakter',
        ];
    }
}
