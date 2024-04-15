<?php

namespace App\Services\MonobankService;

use App\Models\OrderTransaction;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class MonobankService
{
    public function checkout(OrderTransaction $orderTransaction)
    {
        $response = Http::withHeaders(['X-Token' => 'uZbeYZd_4Cja_hiDLY_FExeoL2kuwRNfDKr7qjj2QiuU'])
            ->post('https://api.monobank.ua/api/merchant/invoice/create',
                [
                    'amount' => $orderTransaction->sum,
                    'ccy' => 980,
                    'redirectUrl' => 'http://127.0.0.1:8000/shop',
                ]);

        if($response->successful())
        {
            return $response->json()['invoiceId'];
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

        if($response->successful())
        {
            return $response->json();
        }

        return false;
    }

    public function test()
    {

    }
}
