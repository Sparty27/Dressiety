<?php

namespace App\Services\SmsServices;

use App\Models\EmailTemplate;
use App\Models\SmsTemplate;
use GuzzleHttp\Client;

class SmsService
{
    public $token;
    public $domain;
    public $client;

    public function __construct()
    {
        $this->token = config('mobizon.token');
        $this->domain = config('mobizon.domain');
        $this->client = new Client([
            'base_uri' => $this->domain,
        ]);
    }

    public function getList()
    {
        $response = $this->client->post('/service/message/list', [
            'query' => [
                'apiKey' => $this->token
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function sendMessage($recipient, $text)
    {
        $response = $this->client->post('/service/message/sendsmsmessage', [
            'query' => [
                'apiKey' => $this->token,
                'recipient' => $recipient,
                'text' => $text,
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getSmsTemplate($name)
    {
        return SmsTemplate::where('name', $name)->first() ?? null;
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
