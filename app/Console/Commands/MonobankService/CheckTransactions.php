<?php

namespace App\Console\Commands\MonobankService;

use App\Models\OrderTransaction;
use App\Services\MonobankService\MonobankService;
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
    public function handle(MonobankService $service)
    {
        $orderTransactions = OrderTransaction::shouldCheck()->get();

        dump($orderTransactions);

        foreach($orderTransactions as $orderTransaction)
        {
            $service->check($orderTransaction);
        }
    }
}
