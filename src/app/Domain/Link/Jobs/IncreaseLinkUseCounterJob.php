<?php

namespace App\Domain\Link\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Support\Facades\DB;

//This solution will show poor performance, it is better to use an event bus or specialized databases to collect statistics
class IncreaseLinkUseCounterJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public int $linkId
    ) {
        $this->onQueue('counter');
    }

    public function handle(): void
    {
        DB::table('links')->where('id', $this->linkId)->increment('counts');
    }

    public function middleware(): array
    {
        return [
            new WithoutOverlapping($this->linkId)->expireAfter(2),
        ];
    }
}
