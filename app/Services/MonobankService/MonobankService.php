<?php

namespace App\Services\MonobankService;

use App\Enums\PaymentStatusEnum;
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
            $invoiceId = $response->json()['invoiceId'];

            $orderTransaction->update([
                'transaction_id' => $invoiceId
            ]);

            return $invoiceId;
        }

        return false;
    }

    public function check(OrderTransaction $orderTransaction)
    {
        $response = Http::withHeaders(['X-Token' => 'uZbeYZd_4Cja_hiDLY_FExeoL2kuwRNfDKr7qjj2QiuU'])
            ->get('https://api.monobank.ua/api/merchant/invoice/status',
                [
                    'invoiceId' => $orderTransaction->transaction_id
                ]);

        if($response->successful())
        {
            $status = $response->json()['status'];

            $newStatus = $orderTransaction->status;

            switch($status) {
                case 'processing':
                    $newStatus = PaymentStatusEnum::PROCESS;
                    break;
                case 'success':
                    $newStatus = PaymentStatusEnum::SUCCESS;
                    break;
                case 'failure':
                    $newStatus = PaymentStatusEnum::FAILED;
                    break;
            }

            $orderTransaction->update(
                [
                    'status' => $newStatus
                ]
            );

            return true;
        }

        return false;
    }
}
