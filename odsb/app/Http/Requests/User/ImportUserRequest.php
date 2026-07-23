<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ImportUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'file' => [
                'required',
                'file',
                'mimes:xlsx,xls,csv',
                'max:2048',
            ],

        ];
    }

    public function messages(): array
    {
        return [

            'file.required' => 'File wajib dipilih.',
            'file.file' => 'File tidak valid.',
            'file.mimes' => 'File harus berupa Excel (.xlsx, .xls) atau CSV.',
            'file.max' => 'Ukuran file maksimal 2 MB.',

        ];
    }
}