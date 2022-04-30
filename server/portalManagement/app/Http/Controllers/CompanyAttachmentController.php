<?php

namespace App\Http\Controllers;

use App\Models\CompanyAttachment;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class CompanyAttachmentController extends VoyagerBaseController
{
    public function store(Request $request)
    {
        foreach ($request->attachments as $key => $attachment){
            $fileName = time() . '_' . $attachment->getClientOriginalName();
            $filePath = $attachment->storeAs('companyAttachments', $fileName, 'public');
            CompanyAttachment::create([
                'company_id' => $request->company_id,
                'attachment_type' => $attachment->getClientMimeType(),
                'attachment_name' => time() . '_' . $attachment->getClientOriginalName(),
                'attachment_path' => '/' . $filePath
            ]);
        }

        return redirect()->route('voyager.company-attachments.index');
    }
}
