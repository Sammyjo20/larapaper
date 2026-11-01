<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

/**
 * Temporary tracing for the display/cleanup race investigation.
 *
 * Writes to the dedicated `display_trace` channel (storage/logs/display-trace.log).
 * Every line carries `pid` and a microsecond `at` so concurrent requests touching
 * the same device can be lined up by hand. Remove once the 404 is understood.
 */
class DisplayTrace
{
    /**
     * @param  array<string, mixed>  $context
     */
    public static function log(string $event, array $context = []): void
    {
        Log::channel('display_trace')->debug($event, [
            'pid' => getmypid(),
            'at' => microtime(true),
            ...$context,
        ]);
    }
}
