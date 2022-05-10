<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SubCompanies\SubCompanyRequest;
use App\Http\Requests\Api\SubCompanies\UpdateSubCompayRequest;
use App\Models\SubCompany;
use App\Models\SubCompanyAttachment;
use Illuminate\Http\Request;

class SubCompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = SubCompany::with(['company' => function ($query) {
            $query->select('id', 'name');
        }])->get();
        return response()->json($companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCompanyRequest $request)
    {
        $validated = $request->validated();
        $subCompany = SubCompany::create($request->all());
        foreach ($validated['attachments'] as $key => $attachment){
            $fileName = time() . '_' . $attachment->getClientOriginalName();
            $filePath = $attachment->storeAs('subCompanyAttachments', $fileName, 'public');
            SubCompanyAttachment::create([
                'sub_company_id' => $subCompany->id,
                'attachment_type' => $attachment->getClientMimeType(),
                'attachment_name' => time() . '_' . $attachment->getClientOriginalName(),
                'attachment_path' => '/' . $filePath
            ]);
        }
        return response()->json(['message' => 'Sub Company created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SubCompany $subCompany)
    {
        $response =  SubCompany::with(['attachments' => function ($query) {
            $query->select('id', 'sub_company_id',  'attachment_path');
        }, 'company' => function ($query) {
            $query->select('id', 'name');
        }])->where('id', $subCompany->id)->first();
        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubCompayRequest $request, SubCompany $subCompany)
    {
        $validated = $request->validated();
        $subCompany->update($validated);
        if(!empty($validated['attachments'])){
            foreach ($validated['attachments'] as $key => $attachment){
                $fileName = time() . '_' . $attachment->getClientOriginalName();
                $filePath = $attachment->storeAs('subCompanyAttachments', $fileName, 'public');
                SubCompanyAttachment::create([
                    'sub_company_id' => $subCompany->id,
                    'attachment_type' => $attachment->getClientMimeType(),
                    'attachment_name' => time() . '_' . $attachment->getClientOriginalName(),
                    'attachment_path' => '/' . $filePath
                ]);
            }
        }
        return response()->json(['message' => 'Company updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCompany $subCompany)
    {
        $subCompany->delete();
        return response()->json(['message' => 'Sub Company deleted successfully']);
    }
}
