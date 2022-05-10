<?php

namespace App\Actions;

use App\Models\Company;
use App\Models\SubCompany;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreAttachmentsAction
{
    use AsAction;

    public function handle(array $validated, Company|SubCompany $company)
    {
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
}
