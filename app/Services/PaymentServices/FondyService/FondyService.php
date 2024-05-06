<?php

namespace App\Services\PaymentServices\FondyService;

use App\Enums\PaymentStatusEnum;
use App\Models\OrderTransaction;
use Cloudipsp\Checkout;
use Cloudipsp\Configuration;
use Cloudipsp\Order;
use Illuminate\Http\Request;

class FondyService
{
    public function __construct()
    {
        Configuration::setMerchantId(1396424);
        Configuration::setSecretKey('test');
    }

    public function checkout(OrderTransaction $orderTransaction)
    {
        $order = $orderTransaction->order;

        $data = [
            'order_id' => $order->uuid,
            'order_desc' => 'tests SDK',
            'currency' => 'UAH',
            'amount' => $orderTransaction->sum,
            'response_url' => route('payments.fondy.check', compact('order')),
            'server_callback_url' => route('payments.fondy.webhook', compact('order')),
            'sender_email' => $order->email,
            'lang' => 'ru',
            'product_id' => 'some_product_id',
            'lifetime' => 36000,
            'merchant_data' => array(
                'custom_data1' => 'Some string',
                'custom_data2' => '00000000000',
                'custom_data3' => '3!@#$%^&(()_+?"}'
            )
        ];

        $urlData = Checkout::url($data)->getData();

        $orderTransaction->update(
            [
                'transaction_id' => $urlData['payment_id']
            ]
        );

        return $urlData['checkout_url'];
    }

    public function check(OrderTransaction $orderTransaction)
    {
        $dataToGetStatus = [
            'order_id' => $orderTransaction->order->uuid
        ];

        $orderResponse = Order::status($dataToGetStatus);

        $status = $orderResponse->getData()['order_status'];

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
        $this->check($orderTransaction);
    }

    private function parseStatus(string $status): PaymentStatusEnum
    {
        switch($status) {
            case 'processing':
                return PaymentStatusEnum::PROCESS;
            case 'approved':
                return PaymentStatusEnum::SUCCESS;
            case 'declined':
                return PaymentStatusEnum::FAILED;
            case 'reversed':
                return PaymentStatusEnum::FAILED;
            case 'expired':
                return PaymentStatusEnum::FAILED;
            default:
                return PaymentStatusEnum::PROCESS;
        }
    }
}
