<?php

namespace App\Domain\Link\Controllers;

use App\Domain\Link\Contracts\Actions\GetLinksByUserIdContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class GetListController
{
    public function __invoke(
        Request $request,
        GetLinksByUserIdContract $action
    ): Collection {
        return $action->__invoke($request->user()->id);
    }
}
