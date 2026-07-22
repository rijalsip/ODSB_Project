<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSiteRequest extends FormRequest
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

            'site_id' => [

                'required',
                'string',
                'max:255',

                Rule::unique('sites', 'site_id')
                    ->ignore($this->site),

            ],

            'site_name' => 'required|string|max:255',

            'branch' => 'nullable|string|max:255',

            'cluster' => 'nullable|string|max:255',

            'city' => 'nullable|string|max:255',

            'site_focus_mtd' => 'nullable|string|max:255',

            'kecamatan' => 'nullable|string|max:255',

            'program' => 'nullable|string|max:255',

            'detail_program_ssgj' => 'nullable|string|max:255',

            'new_infra' => 'nullable|string|max:255',

            'tech' => 'nullable|string|max:255',

            'class' => 'nullable|string|max:255',

            'ne' => 'nullable|string|max:255',

            'network_condition' => 'nullable|string|max:255',

        ];
    }
}