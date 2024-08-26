<?php

namespace App\Services\LoggingServices;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use App\Models\Log;
use Monolog\LogRecord;

class DatabaseLogger
{
    public function __invoke(array $config)
    {
        return new Logger('database', [new class extends AbstractProcessingHandler {
            protected function write(LogRecord $record): void
            {
                Log::create([
                    'level' => $record->level,
                    'message' => $record->message,
                    'context' => $record->context,
                ]);
            }
        }]);
    }
}
