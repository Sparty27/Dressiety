<?php

namespace App\Jobs\NovaPoshta;

use App\Services\NovaPoshtaService\NovaPoshtaWarehouseService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateWarehouseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 0;

    private int $page;
    private int $limit;

    /**
     * Create a new job instance.
     */
    public function __construct(int $page, int $limit)
    {
        $this->page = $page;
        $this->limit = $limit;
    }

    /**
     * Execute the job.
     */
    public function handle(NovaPoshtaWarehouseService $service): void
    {
        Log::channel('daily')->info("UpdateWarehouseJob | Page: $this->page, Limit: $this->limit");

        try {
            $service->update($this->page, $this->limit);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        DB::disconnect();
        gc_collect_cycles();
    }
}
