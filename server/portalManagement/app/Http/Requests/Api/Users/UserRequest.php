<?php

namespace App\Http\Requests\Api\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'nationality' => 'required|string',
            'nationality_ar' => 'required|string',
            'passport_number' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'postal_code' => 'required|string',
            'civil_id' => 'required|string|max:12|unique:users',
            'passport_expiry_date' => 'required|date',
            'residence_expiry_date' => 'required|date',
            'expired_at' => 'required|date',
            'company_id' => 'required|integer|exists:companies,id',
            'sub_company_id' => 'nullable',
            'role_id' => 'required|integer|exists:roles,id',
            'attachments' => 'required|array',
            'supervisor' => 'nullable',
            'phone1' => 'required|string',
            'phone2' => 'nullable|string',
            'phone3' => 'nullable|string',
        ];
    }
}
