<?php

namespace App\Console\Commands\NovaPoshtaService;

use App\Services\NovaPoshtaService\NovaPoshtaService;
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
    protected $description = 'Update cities where there is NovaPoshta';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $limit = 100;

        $cityJobsNeeded = (int) ceil(NovaPoshtaService::getTotalCount(NovaPoshtaService::CITIES) / $limit);

        for ($page = 1; $page <= $cityJobsNeeded; $page++) {
            UpdateCityJob::dispatch($page, $limit);
        }
    }
}
