<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JualRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        $rules = [
            // 'No_Faktur' => "required|string|size:6|unique:T_Jual,No_Faktur",
            'Kode_Customer' => 'required|string|size:4|exists:T_Customer,Kode_Customer',
            'Kode_Tjen' => 'required|string|size:1|exists:T_JEN,Kode_Tjen',
            'Tgl_Faktur' => 'required|date',
            'Total_Bruto' => 'required|numeric',
            'Total_Diskon' => 'required|numeric',
            'Total_Jumlah' => 'required|numeric',
        ];

        if ($this->isMethod('post')) {
            $rules['No_Faktur'] = 'required|string|unique:T_Jual,No_Faktur';
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['No_Faktur'] = [
                'required',
                'string',
                'size:6',
                Rule::unique('T_Jual', 'No_Faktur')->ignore($this->input('No_Faktur'), 'No_Faktur'),
            ];
        }


        return $rules;
    }

    public function messages(): array
    {
        return [
            'No_Faktur.required' => 'Nomor faktur wajib diisi',
            'No_Faktur.size' => 'Nomor faktur harus 6 karakter',
            'No_Faktur.unique' => 'Nomor faktur sudah ada',
            'Kode_Customer.required' => 'Kode customer wajib diisi',
            'Kode_Customer.size' => 'Kode customer harus 4 karakter',
            'Kode_Customer.exists' => 'Kode customer tidak ditemukan',
            'Kode_Tjen.required' => 'Kode Tjen wajib diisi',
            'Kode_Tjen.size' => 'Kode Tjen harus 1 karakter',
            'Kode_Tjen.exists' => 'Kode Tjen tidak ditemukan',
            'Tgl_Faktur.required' => 'Tanggal faktur wajib diisi',
            'Tgl_Faktur.date' => 'Tanggal faktur harus berupa tanggal yang valid',
            'Total_Bruto.required' => 'Total bruto wajib diisi',
            'Total_Bruto.numeric' => 'Total bruto harus berupa angka',
            'Total_Diskon.required' => 'Total diskon wajib diisi',
            'Total_Diskon.numeric' => 'Total diskon harus berupa angka',
            'Total_Jumlah.required' => 'Total jumlah wajib diisi',
            'Total_Jumlah.numeric' => 'Total jumlah harus berupa angka',
        ];
    }
}
