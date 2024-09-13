<?php

namespace App\Jobs\NovaPoshta;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\NovaPoshtaService\NovaPoshtaCityService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateCityJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 0;

    private int $page;
    private int $limit;

    /**
     * Create a new job instance.
     */
    public function __construct($page, $limit)
    {
        $this->page = $page;
        $this->limit = $limit;
    }

    /**
     * Execute the job.
     */
    public function handle(NovaPoshtaCityService $service): void
    {
        Log::channel('daily')->info("UpdateCityJob | Page: $this->page, Limit: $this->limit");

        try {
            $service->update($this->page, $this->limit);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
