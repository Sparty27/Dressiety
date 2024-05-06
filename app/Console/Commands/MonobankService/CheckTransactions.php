<?php

namespace App\Console\Commands\MonobankService;

use App\Models\OrderTransaction;
use App\Services\PaymentServices\FondyService\FondyService;
use App\Services\PaymentServices\MonobankService\MonobankService;
use Illuminate\Console\Command;

class CheckTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-transactions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(MonobankService $monobankService, FondyService $fondyService)
    {
        $orderTransactions = OrderTransaction::shouldCheck()->get();

        dump($orderTransactions);

        foreach($orderTransactions as $orderTransaction)
        {
            switch($orderTransaction->type) {
                case OrderTransaction::MONOBANK:
                    dump('monobank type. Type: '.$orderTransaction->type);
                    $monobankService->check($orderTransaction);
                    break;
                case OrderTransaction::FONDY:
                    dump('fondy type. Type: '.$orderTransaction->type);
                    $fondyService->check($orderTransaction);
                    break;
            }
        }
    }
}
