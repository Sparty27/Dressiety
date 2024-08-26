<?php

namespace App\Console\Commands\NovaPoshtaService;

use App\Jobs\NovaPoshta\UpdateAreaJob;
use App\Services\NovaPoshtaService\NovaPoshtaAreaService;
use Illuminate\Console\Command;

class UpdateArea extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'np:update-area';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update areas where there is NovaPoshta';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        UpdateAreaJob::dispatch();
    }
}
