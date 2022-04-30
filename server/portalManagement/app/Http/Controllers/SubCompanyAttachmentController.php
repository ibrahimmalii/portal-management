<?php

namespace App\Http\Controllers;

use App\Models\SubCompanyAttachment;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class SubCompanyAttachmentController extends VoyagerBaseController
{
    public function store(Request $request)
    {
        foreach ($request->attachments as $key => $attachment){
            $fileName = time() . '_' . $attachment->getClientOriginalName();
            $filePath = $attachment->storeAs('subCompanyAttachments', $fileName, 'public');
            SubCompanyAttachment::create([
                'sub_company_id' => $request->sub_company_id,
                'attachment_type' => $attachment->getClientMimeType(),
                'attachment_name' => time() . '_' . $attachment->getClientOriginalName(),
                'attachment_path' => '/' . $filePath
            ]);
        }

        return redirect()->route('voyager.sub-company-attachments.index');
    }
}
