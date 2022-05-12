<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            'name' => 'required|string|unique:companies,name,' . $this->company->id,
            'name_ar' => 'required|string',
            'license_number' => 'required|string',
            'license_address' => 'required|string',
            'date_of_issuance_of_license' => 'required|date',
            'central_number' => 'required|string',
            'file_number' => 'required|string',
            'civil_authority_number' => 'required|string',
            'commercial_register_number' => 'required|string',
            'address_automatic_number' => 'required|string',
            'description' => 'required|string',
            'address' => 'required|string',
            'expired_at' => 'required|date',
            'attachments' => 'nullable',
        ];
    }
}
