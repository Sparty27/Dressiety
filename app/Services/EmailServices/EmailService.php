<?php

namespace App\Services\EmailServices;

use App\Enums\EmailTemplateEnum;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Log;
use PharIo\Manifest\Email;

class EmailService
{
    private function getEmailTemplate($name)
    {
        return EmailTemplate::where('name', $name)->first() ?? null;
    }

    private function replacePlaceholders($data, $template)
    {
        foreach($data as $key => $value)
        {
            $template = str_replace($key, $value, $template);
        }

        return $template;
    }

    public function getEmailData(EmailTemplateEnum $enum, $arrayData)
    {
        $emailTemplate = $this->getEmailTemplate($enum->value);

        $emailData['subject'] = $this->replacePlaceholders($arrayData, $emailTemplate->subject);
        $emailData['body'] = $this->replacePlaceholders($arrayData, $emailTemplate->body);

        return $emailData;
    }
}
