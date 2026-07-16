<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class ImportSiteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation Rules
     */
    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'file',
                'mimes:xlsx,xls',
                'max:10240',
            ],
        ];
    }

    /**
     * Custom Message
     */
    public function messages(): array
    {
        return [

            'file.required' => 'Silakan pilih file Excel.',

            'file.file' => 'File yang dipilih tidak valid.',

            'file.mimes' => 'File harus berformat .xlsx atau .xls.',

            'file.max' => 'Ukuran file maksimal 10 MB.',

        ];
    }
}