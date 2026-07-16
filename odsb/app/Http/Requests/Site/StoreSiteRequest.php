<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class StoreSiteRequest extends FormRequest
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
            'site_id' => [
                'required',
                'string',
                'max:100',
                'unique:sites,site_id',
            ],

            'site_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'regional' => [
                'nullable',
                'string',
                'max:100',
            ],

            'branch' => [
                'nullable',
                'string',
                'max:100',
            ],

            'cluster' => [
                'nullable',
                'string',
                'max:100',
            ],

            'kabupaten' => [
                'nullable',
                'string',
                'max:100',
            ],

            'kecamatan' => [
                'nullable',
                'string',
                'max:100',
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'latitude' => [
                'nullable',
                'numeric',
            ],

            'longitude' => [
                'nullable',
                'numeric',
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
            'site_id.required' => 'Site ID wajib diisi.',
            'site_id.unique' => 'Site ID sudah digunakan.',
            'site_id.max' => 'Site ID maksimal 100 karakter.',
        ];
    }
}