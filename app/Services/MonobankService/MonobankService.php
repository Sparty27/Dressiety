<?php

namespace App\Services\MonobankService;

use App\Enums\PaymentStatusEnum;
use App\Models\Order;
use App\Models\OrderTransaction;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class MonobankService
{
    private $token;
    private $domain;
    public function __construct()
    {
        $this->token = config('monobank.token');
        $this->domain = config('monobank.domain');
    }

    public function checkout(OrderTransaction $orderTransaction)
    {
        $order = $orderTransaction->order;

        $responseData = $this->makeRequest('/merchant/invoice/create', 'post',
            [
                'amount' => $orderTransaction->sum,
                'ccy' => 980,
                'redirectUrl' => route('payments.monobank.check', compact('order')),
                'webhookUrl' => route('payments.monobank.webhook', compact('order'))
            ]);

        $invoiceId = $responseData['invoiceId'];

        $orderTransaction->update([
            'transaction_id' => $invoiceId
        ]);

        return $responseData['pageUrl'];

        return true;
    }

    public function check(OrderTransaction $orderTransaction)
    {
        $responseData = $this->makeRequest('/merchant/invoice/status', 'get',
            [
                'invoiceId' => $orderTransaction->transaction_id
            ]);

        $status = $responseData['status'];

        $oldStatus = $orderTransaction->status;

        $newStatus = $this->parseStatus($status);

        if($newStatus != $oldStatus)
        {
            $orderTransaction->update(
                [
                    'status' => $newStatus
                ]
            );
        }

        return $orderTransaction;
    }

    public function webhook(Request $request, OrderTransaction $orderTransaction)
    {
        if(!$this->verify($request))
            return $orderTransaction;

        $requestData = $request->all();

        $status = $requestData['status'];

        $oldStatus = $orderTransaction->status;

        $newStatus = $this->parseStatus($status);

        if($newStatus != $oldStatus)
        {
            $orderTransaction->update(
                [
                    'status' => $newStatus
                ]
            );
        }

        return $orderTransaction;
    }

    private function parseStatus(string $status): PaymentStatusEnum
    {
        switch($status) {
            case 'processing':
                return PaymentStatusEnum::PROCESS;
            case 'success':
                return PaymentStatusEnum::SUCCESS;
            case 'failure':
                return PaymentStatusEnum::FAILED;
            default:
                return PaymentStatusEnum::PROCESS;
        }
    }

    private function prepareRequest(): PendingRequest
    {
        return Http::withHeaders(['X-Token' => $this->token]);
    }

    private function prepareResponse($response): array
    {
        if(!$response->successful())
            throw new \Exception(implode(' ', $response->json()));

        return $response->json();
    }

    private function url($endpoint): string
    {
        return $this->domain.$endpoint;
    }

    private function makeRequest($endpoint, $method, $data): array
    {
        $response = $this->prepareRequest()
            ->{$method}($this->url($endpoint),
                $data);


        return $this->prepareResponse($response);
    }

    private function getPubKey()
    {
        return config('monobank.pubkey', null);
    }

    private function verify(Request $request)
    {
        $pubKeyBase64 = $this->getPubKey();

        $xSignBase64 = $request->header('x-sign');

        $message = json_encode($request->all());

        $signature = base64_decode($xSignBase64);
        $publicKey = openssl_get_publickey(base64_decode($pubKeyBase64));

        $result = openssl_verify($message, $signature, $publicKey, OPENSSL_ALGO_SHA256);

        return $result;
    }
}
