<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CompanyRequest;
use App\Http\Requests\Api\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\CompanyAttachment;
use App\Models\SubCompany;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(){
        $companies = Company::all();
        return response()->json($companies);
    }

    /**
     * Get Dropdown of all companies
     * return JsonResponse
     *
     */
    public function getDropDown(): JsonResponse
    {
        $companies = Company::select('id', 'name', 'name_ar')->get();
        return response()->json($companies);
    }

    public function getUsers(Company $company)
    {
        $users = $company->users()->get();
        return response()->json($users);
    }

    /**
     * Get related sub companies
     *
     *
     * @param Company $company
     * @return JsonResponse
     *
     */
    public function getRelatedSubCompanies(Company $company): JsonResponse
    {
        $subCompanies = $company->sub_companies()->select('id', 'name', 'name_ar')->get();
        return response()->json($subCompanies);
    }


    public function store(CompanyRequest $request)
    {
        $validated = $request->validated();
        $company = Company::create($validated);

            foreach ($validated['attachments'] as $key => $attachment){
                $fileName = time() . '_' . $attachment->getClientOriginalName();
                $filePath = $attachment->storeAs('companyAttachments', $fileName, 'public');
                CompanyAttachment::create([
                    'company_id' => $company->id,
                    'attachment_type' => $attachment->getClientMimeType(),
                    'attachment_name' => time() . '_' . $attachment->getClientOriginalName(),
                    'attachment_path' => '/' . $filePath
                ]);
            }
        return response()->json(['message' => 'Company created successfully']);
    }

    /**
     * Display a listing of the resource.
     */
    public function show(Company $company){
        $response =  Company::with(['attachments' => function ($query) {
            $query->select('id', 'company_id', 'attachment_path');
        }, 'sub_companies', 'users'])->where('id', $company->id)->first();
        return response()->json($response);
    }

    public function delete(Company $company){
        $company->delete();
        return response()->json(['message' => 'Company deleted successfully']);
    }


    public function update(UpdateCompanyRequest $request, Company $company){
        $validated = $request->validated();
        $company->update($validated);
        if(!empty($validated['attachments'])){
            foreach ($validated['attachments'] as $key => $attachment){
                $fileName = time() . '_' . $attachment->getClientOriginalName();
                $filePath = $attachment->storeAs('companyAttachments', $fileName, 'public');
                CompanyAttachment::create([
                    'company_id' => $company->id,
                    'attachment_type' => $attachment->getClientMimeType(),
                    'attachment_name' => time() . '_' . $attachment->getClientOriginalName(),
                    'attachment_path' => '/' . $filePath
                ]);
            }
        }
        return response()->json(['message' => 'Company updated successfully']);
    }

}
