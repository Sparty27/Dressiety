<?php

namespace App\Console\Commands\NovaPoshtaService;

use Illuminate\Console\Command;
use App\Jobs\NovaPoshta\UpdateCityJob;
use App\Services\NovaPoshtaService\NovaPoshtaCityService;

class UpdateCity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'np:update-city';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        UpdateCityJob::dispatch();
    }
}
