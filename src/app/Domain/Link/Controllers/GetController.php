<?php

namespace App\Domain\Link\Controllers;

use App\Domain\Link\Contracts\Actions\GetLinkByIdContract;
use App\Domain\Link\Models\Link;
use App\Domain\Link\Requests\GetLinkRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GetController
{
    public function __invoke(
        GetLinkRequest $request,
        GetLinkByIdContract $action
    ): Link {
        try {
            return $action->__invoke($request->input('id'));
        } catch (ModelNotFoundException) {
            abort(404);
        }
    }
}
