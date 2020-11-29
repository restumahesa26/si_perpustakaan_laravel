<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CurrentPassword;
use Illuminate\Support\Facades\Auth;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required', 'string', 'max:255'
            ],
            'email' => [
                'required', 'email', 'max:255',
            ],
            'current_password' => [
                'required', 'string', new CurrentPassword()
            ],
            'password' => [
                'required', 'string', 'min:8', 'confirmed'
            ],
            'roles' => [
                'required', 'in:ADMIN,STAF'
            ],
            'username' => [
                'required', 'string', 'max:255'
            ], 
            'nip' => [
                'required', 'string', 'max:20'
            ],
        ];
    }
}
