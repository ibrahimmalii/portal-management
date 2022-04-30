<?php

namespace App\Http\Controllers;

use App\Models\UserAttachment;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class UserAttachmentController extends VoyagerBaseController
{
    public function store(Request $request)
    {
        foreach ($request->attachments as $key => $attachment){
            $fileName = time() . '_' . $attachment->getClientOriginalName();
            $filePath = $attachment->storeAs('userAttachments', $fileName, 'public');
            UserAttachment::create([
                'user_id' => $request->user_id,
                'attachment_type' => $attachment->getClientMimeType(),
                'attachment_name' => time() . '_' . $attachment->getClientOriginalName(),
                'attachment_path' => '/' . $filePath
            ]);
        }

        return redirect()->route('voyager.user-attachments.index');
    }
}
