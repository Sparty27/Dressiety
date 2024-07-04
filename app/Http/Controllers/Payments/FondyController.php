<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\PaymentServices\FondyService\FondyService;
use App\Services\PaymentServices\MonobankService\MonobankService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FondyController extends Controller
{
    public function check(Order $order, FondyService $service)
    {
        $orderTransaction = $order->orderTransaction;

        try {
            $service->check($orderTransaction);

            return view('payments.success', compact('orderTransaction'));
        } catch(Exception $ex) {
            Log::channel('daily')->error($ex->getMessage());

            return view('payments.success', compact('orderTransaction'));
        }
    }

    public function webhook(Request $request, Order $order, FondyService $service)
    {
        try {
            $service->webhook($request, $order->orderTransaction);

            return response(status: 200);
        } catch(Exception $ex) {
            Log::channel('daily')->error($ex->getMessage());

            return response(status: 200);
        }
    }
}
