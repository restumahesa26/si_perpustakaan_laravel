<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BukuRequest extends FormRequest
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
            'kategori_id' => 'required|numeric',
            'penerbit_id' => 'required|numeric',
            'judul' => 'required|min:3|max:100',
            'isbn' => 'required|min:3|max:20',
            'pengarang' => 'required|min:3|max:50',
            'halaman' => 'required|numeric',
            'thn_terbit' => 'required|numeric|digits:4',
            'scan' => 'image|mimes:jpeg,png,jpg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'judul.required' => 'Oops.. field Judul belum diisi',
            'judul.min' => 'Judul tidak valid',
            'judul.unique' => 'Judul Buku sudah ada cuy',
            'isbn.required' => 'Oops.. field ISBN belum diisi',
            'isbn.min' => 'ISBN tidak valid',
            'pengarang.required' => 'Oops.. field Pengarang belum diisi',
            'pengarang.min' => 'Pengarang tidak valid',
            'halaman.required' => 'Oops.. field Halaman belum diisi',
            'halaman.numeric' => 'Harus berupa angka',
            'thn_terbit.required' => 'Oops.. field Tahun Terbit belum diisi',
            'thn_terbit.digits' => 'Tahun terbit harus diisi 4 digits angka',
            'thn_terbit.numeric' => 'Field ini harus berupa angka',
            'kategori_id.numeric' => 'Kategori tidak valid',
            'kategori_id.required' => 'Kategori tidak valid',
            'penerbit_id.numeric' => 'Penerbit tidak valid',
            'penerbit_id.required' => 'Penerbit tidak valid',
            'scan.image' => 'File harus berupa gambar', 
            'scan.mimes' => 'Foto harus berformat jpeg, jpg atau png', 
            'scan.max' => 'File harus berukuran kurang dari 2 MB'
        ];     
    }
}
