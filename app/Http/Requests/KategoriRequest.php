<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KategoriRequest extends FormRequest
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
            'namaKategori' => 'required|min:3|max:50'
        ];
    }

    public function messages()
    {
        return [
            'namaKategori.required' => 'Oops.. field nama kategori belum diisi',
            'namaKategori.min' => 'Kategori tidak valid',
            'namaKategori.max' => 'Kategori tidak valid'
        ];     
    }
}
