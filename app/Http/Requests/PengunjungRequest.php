<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengunjungRequest extends FormRequest
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
            'no_idt' => 'required|min:4|max:30',
            'nama' => 'required|min:3|max:100',
            'jk' => 'required',
            'no_hp' => 'required|numeric|digits_between:11,13',
            'alamat' => 'required|min:5|max:150',
            'password' => 'required|min:8|max:50'
        ];
    }

    public function messages()
    {
        return [
            'no_idt.required' => 'Oops.. field No Identitas belum diisi',
            'no_idt.min' => 'No Identitas tidak valid',
            'no_idt.max' => 'No Identitas tidak valid',
            'password.required' => 'Oops.. field Password belum diisi',
            'password.min' => 'Password Minimal 8',
            'password.max' => 'Password Maksimal 20',
            'nama.required' => 'Oops.. field Nama belum diisi',
            'nama.min' => 'Nama tidak valid',
            'nama.max' => 'Nama tidak valid',
            'jk.required' => 'Oops.. field Jenis Kelamin belum diisi',
            'no_hp.required' => 'Oops.. field No Handphone belum diisi',
            'no_hp.numeric' => 'Field ini harus berupa angka',
            'no_hp.digits_between' => 'Masukkan No Handphone dengan benar',
            'alamat.required' => 'Oops.. field Alamat belum diisi',
            'alamat.min' => 'Alamat tidak valid',
            'alamat.max' => 'Alamat tidak valid',
        ];     
    }
}
