<?php

namespace App\Console\Commands\NovaPoshtaService;

use App\Jobs\NovaPoshta\UpdateWarehouseJob;
use App\Services\NovaPoshtaService\NovaPoshtaWarehouseService;
use Illuminate\Console\Command;

class UpdateWarehouse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'np:update-warehouse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update warehouses that NovaPoshta has in the city';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        UpdateWarehouseJob::dispatch();
    }
}
