<?php

namespace App\Services\SmsServices;

use App\Models\EmailTemplate;
use App\Models\SmsTemplate;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

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

    public function sendMessage($recipient, $templateName, $array)
    {
        $template = $this->getSmsTemplate($templateName);

        $text = $this->replacePlaceholders($template->text, $array);

        try {
            $response = $this->client->post('/service/message/sendsmsmessage', [
                'query' => [
                    'apiKey' => $this->token,
                    'recipient' => $recipient,
                    'text' => $text,
                ]
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return json_decode($response->getBody()->getContents(), true);
    }

    private function getSmsTemplate($name)
    {
        return SmsTemplate::where('name', $name)->first() ?? null;
    }

    private function replacePlaceholders($template, $data)
    {
        foreach($data as $key => $value)
        {
            $template = str_replace($key, $value, $template);
        }

        return $template;
    }
}
