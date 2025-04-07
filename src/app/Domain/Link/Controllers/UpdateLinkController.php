<?php

namespace App\Domain\Link\Controllers;

use App\Domain\Link\Contracts\Actions\CreateLinkContract;
use App\Domain\Link\Contracts\Actions\UpdateLinkContract;
use App\Domain\Link\Requests\CreateLinkRequest;
use App\Domain\Link\Requests\UpdateLinkRequest;
use App\Infrastructure\Abstracts\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

class UpdateLinkController extends Controller
{
    /**
     * @param int                $id
     * @param UpdateLinkRequest  $request
     * @param UpdateLinkContract $action
     *
     * @return Response
     */
    public function __invoke(
        int $id,
        UpdateLinkRequest $request,
        UpdateLinkContract $action
    ): Response {
        $data = $request->validated();

        try {
            $link = $action->__invoke($id, $data);
            return response($link, 200);
        } catch (ModelNotFoundException) {
            abort(404);
        }
    }
}
