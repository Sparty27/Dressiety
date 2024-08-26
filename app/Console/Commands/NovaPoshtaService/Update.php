<?php

namespace App\Console\Commands\NovaPoshtaService;

use App\Jobs\NovaPoshta\UpdateAreaJob;
use App\Jobs\NovaPoshta\UpdateCityJob;
use App\Jobs\NovaPoshta\UpdateWarehouseJob;
use Illuminate\Console\Command;

class Update extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'np:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update areas, cities and warehouses where there is NovaPoshta';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        UpdateAreaJob::dispatch();
        UpdateCityJob::dispatch();
        UpdateWarehouseJob::dispatch();
    }
}
