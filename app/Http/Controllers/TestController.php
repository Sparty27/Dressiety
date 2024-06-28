<?php

namespace App\Http\Controllers;

use App\Events\ProductOrdered;
use App\Mail\Mailer;
use App\Mail\ProductOrderedMail;
use App\Models\Order;
use App\Models\OrderTransaction;
use App\Models\Product;
use App\Models\SmsTemplate;
use App\Services\EmailServices\EmailService;
use App\Services\MyDropServices\MyDropProductService;
use App\Services\PaymentServices\FondyService\FondyService;
use App\Services\SmsServices\SmsService;
use Cloudipsp\HttpClient\HttpGuzzle;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MyDropProductService $service)
    {
        $service->parse();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
