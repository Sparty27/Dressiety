<?php

namespace App\Jobs\NovaPoshta;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\NovaPoshtaService\NovaPoshtaCityService;

class UpdateCityJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(NovaPoshtaCityService $service): void
    {
        ini_set('memory_limit', '-1');
        $result = $service->update();
    }
}
