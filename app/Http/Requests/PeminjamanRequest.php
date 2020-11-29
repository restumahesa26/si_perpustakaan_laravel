<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeminjamanRequest extends FormRequest
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
            'pengunjung_id' => 'required',
            'keterangan' => 'required|min:3|max:150',
        ];
    }

    public function messages()
    {
        return [
            'pengunjung_id.required' => 'Oops.. field No Identitas belum diisi',
            'alamat.min' => 'Alamat tidak valid',
            'alamat.max' => 'Alamat tidak valid',
        ];     
    }
}
