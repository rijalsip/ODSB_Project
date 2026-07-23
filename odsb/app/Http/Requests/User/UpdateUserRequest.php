<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
                Rule::unique('users', 'username')
                    ->ignore($this->route('user')),
            ],

           'id_digipos' => [
    'required',
    'string',
    'max:100',
    Rule::unique('users', 'id_digipos')
        ->ignore($this->route('user')),
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
                Rule::unique('users', 'telegram_chat_id')
                    ->ignore($this->route('user')),
            ],

            'telegram_username' => [
                'nullable',
                'string',
                'max:100',
            ],

            'password' => [
                'nullable',
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
            
            'role_id.exists' => 'Role tidak ditemukan.',
        ];
    }
}