<?php

namespace App\Domain\Link\Controllers;

use App\Domain\Link\Contracts\Actions\GetLinkByCodeContract;
use App\Domain\Link\Jobs\IncreaseLinkUseCounterJob;
use App\Infrastructure\Abstracts\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Log;
use Throwable;

class RedirectController extends Controller
{
    /**
     * @param string $code
     * @param GetLinkByCodeContract $action
     *
     * @return RedirectResponse
     */
    public function __invoke(
        string $code,
        GetLinkByCodeContract $action
    ): RedirectResponse {
        try {
            $link = $action->__invoke($code);
            IncreaseLinkUseCounterJob::dispatch($link->id);
            return redirect($link->original);
        } catch (Throwable $exception) {
            Log::error(
                $exception->getMessage(),
                ['code' => $code, 'type' => 'redirect']
            );
            abort(404);
        }
    }
}
