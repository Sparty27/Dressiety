<?php

namespace App\Services\EmailServices;

use App\Models\EmailTemplate;
use PharIo\Manifest\Email;

class EmailService
{
    public function getEmailTemplate($name)
    {
        return EmailTemplate::where('name', $name)->first() ?? null;
    }

    public function replacePlaceholders($data, $template)
    {
        foreach($data as $key => $value)
        {
            $template = str_replace($key, $value, $template);
        }

        return $template;
    }
}
