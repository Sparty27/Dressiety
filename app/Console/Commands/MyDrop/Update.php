<?php

namespace App\Console\Commands\MyDrop;

use App\Jobs\MyDrop\UpdateProducts;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class Update extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mydrop:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update products and their categories from MyDrop';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            UpdateProducts::dispatch();
        } catch (Exception $e) {
            Log::channel('daily')->error('Job failed: ' . $e->getMessage());
            throw $e;
        }
    }
}
