<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CompanyRequest;
use App\Models\Company;
use App\Models\CompanyAttachment;
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
        return $company;
    }

    public function delete(Company $company){
        $company->delete();
        return response()->json(['message' => 'Company deleted successfully']);
    }


    public function update(CompanyRequest $request, Company $company){
        $validated = $request->validated();
        $company->update($validated);
        return response()->json(['message' => 'Company updated successfully']);
    }

}
