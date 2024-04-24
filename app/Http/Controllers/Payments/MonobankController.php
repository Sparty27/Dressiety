<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderTransaction;
use App\Services\MonobankService\MonobankService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MonobankController extends Controller
{
    public function check(Order $order, MonobankService $service)
    {
        $orderTransaction = $order->orderTransaction;

        try {
            $service->check($orderTransaction);

            return view('payments.success', compact('orderTransaction'));
        } catch(Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    public function webhook(Request $request, Order $order, MonobankService $service)
    {
        try {
            $service->webhook($request, $order->orderTransaction);

            return response(status: 200, headers: ['x-sign' => $request->header('x-sign')]);
        } catch(Exception $ex) {
            Log::error($ex->getMessage());

            return response(status: 200, headers: ['x-sign' => $request->header('x-sign')]);
        }
    }
}
