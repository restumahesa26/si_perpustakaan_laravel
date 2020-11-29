<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengadaanRequest extends FormRequest
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
            'buku_id' => 'required|min:3|max:10', 
            'asal_buku' => 'required|min:3|max:30',
            'jml_masuk' => 'required|numeric', 
            'keterangan' => 'required|min:3|max:150',
            'tanggal' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'buku_id.required' => 'Oops.. field ID Buku belum diisi',
            'buku_id.min' => 'ID Buku tidak valid',
            'buku_id.max' => 'ID Buku tidak valid',
            'asal_buku.required' => 'Oops.. field Asal Buku belum diisi',
            'asal_buku.min' => 'Asal Buku tidak valid',
            'asal_buku.max' => 'Asal Buku tidak valid',
            'jml_masuk.required' => 'Oops.. field Jumlah Masuk belum diisi',
            'jml_masuk.numeric' => 'Field ini harus berupa angka',
            'keterangan.required' => 'Oops.. field Keterangan belum diisi',
            'keterangan.min' => 'Keterangan tidak valid',
            'keterangan.max' => 'Keterangan tidak valid',
            'tanggal.required' => 'Oops.. field Tanggal belum diisi'
        ];     
    }
}
