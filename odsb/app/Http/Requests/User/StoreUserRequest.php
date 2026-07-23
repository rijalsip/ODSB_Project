<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
        ]);
    }

    public function rules(): array
    {
        return [
            'role_id' => [
                'nullable',
                'exists:roles,id',
            ],

            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'username' => [
                'nullable',
                'string',
                'max:100',
                'unique:users,username',
            ],

           'id_digipos' => [
    'nullable',
    'string',
    'max:255',
    'unique:users,id_digipos',
],

'cluster' => [
    'required',
    'string',
    'max:100',
],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'telegram_chat_id' => [
                'nullable',
                'string',
                'unique:users,telegram_chat_id',
            ],

            'telegram_username' => [
                'nullable',
                'string',
                'max:100',
            ],

            'password' => [
                'required',
                'string',

            ],

            'is_active' => [
                'required',
                'boolean',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
           'id_digipos.required' => 'ID Digipos wajib diisi.',
'id_digipos.unique' => 'ID Digipos sudah digunakan.',
'cluster.required' => 'Cluster wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'telegram_chat_id.unique' => 'Telegram Chat ID sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            
            'role_id.exists' => 'Role tidak ditemukan.',
        ];
    }
}