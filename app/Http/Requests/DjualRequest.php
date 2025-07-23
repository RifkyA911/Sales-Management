<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DjualRequest extends FormRequest
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
        $rules = [
            'No_Faktur' => 'required|exists:T_Jual,No_Faktur',
            'Kode_Barang' => [
                'required',
                'exists:T_Barang,Kode_Barang',
            ],
            'Harga' => 'required|numeric|min:0',
            'Qty' => 'required|numeric|min:0.01',
            'Diskon' => 'required|numeric|min:0',
            'Bruto' => 'required|numeric|min:0',
            'Jumlah' => 'required|numeric|min:0',
        ];

        // Cek untuk create (POST)
        if ($this->isMethod('post')) {
            $rules['Kode_Barang'][] = Rule::unique('T_DJual')->where(function ($query) {
                return $query->where('No_Faktur', $this->No_Faktur);
            });
        }

        // Untuk update (PUT/PATCH) tidak perlu unique check
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['Kode_Barang'][] = Rule::exists('T_Barang', 'Kode_Barang');
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'No_Faktur.required' => 'Nomor faktur wajib diisi',
            'No_Faktur.exists' => 'Nomor faktur tidak ditemukan',
            'Kode_Barang.required' => 'Kode barang wajib diisi',
            'Kode_Barang.exists' => 'Kode barang tidak ditemukan',
            'Kode_Barang.unique' => 'Kode barang sudah ada dalam faktur ini',
            'Harga.required' => 'Harga wajib diisi',
            'Harga.numeric' => 'Harga harus berupa angka',
            'Qty.required' => 'Jumlah wajib diisi',
            'Qty.numeric' => 'Jumlah harus berupa angka',
            'Qty.min' => 'Jumlah minimal adalah 0.01',
            'Diskon.required' => 'Diskon wajib diisi',
            'Diskon.numeric' => 'Diskon harus berupa angka',
            'Diskon.min' => 'Diskon minimal adalah 0',
            'Bruto.required' => 'Bruto wajib diisi',
            'Bruto.numeric' => 'Bruto harus berupa angka',
            'Bruto.min' => 'Bruto minimal adalah 0',
            'Jumlah.required' => 'Jumlah wajib diisi',
            'Jumlah.numeric' => 'Jumlah harus berupa angka',
            'Jumlah.min' => 'Jumlah minimal adalah 0',
        ];
    }
}
