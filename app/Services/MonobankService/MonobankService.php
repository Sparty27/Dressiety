<?php

namespace App\Services\MonobankService;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class MonobankService
{
    public function checkout()
    {
        $response = Http::withHeaders(['X-Token' => 'uZbeYZd_4Cja_hiDLY_FExeoL2kuwRNfDKr7qjj2QiuU'])
            ->post('https://api.monobank.ua/api/merchant/invoice/create',
                [
                    'amount' => 10000,
                    'ccy' => 980,
                    'redirectUrl' => 'http://127.0.0.1:8000/paymentInfo',
                    'merchantPaymInfo' =>
                        [
                            'destination' => 'Т-72Б3',
                            'comment' => 'Soviet tank',
                            'customerEmails' =>
                                [
                                    'nazarzadrot8@gmail.com'
                                ],
                        ]
                ]);

        dump($response);
        dump($response->json());

        if($response->successful())
        {
            return $response->json();
        }

        return false;
    }

    public function check($invoiceId)
    {
        $response = Http::withHeaders(['X-Token' => 'uZbeYZd_4Cja_hiDLY_FExeoL2kuwRNfDKr7qjj2QiuU'])
            ->get('https://api.monobank.ua/api/merchant/invoice/status',
                [
                    'invoiceId' => $invoiceId
                ]);

        dump($response);
        dd($response->json());
    }

    public function test()
    {
        $data = $this->checkout();

    }
}
