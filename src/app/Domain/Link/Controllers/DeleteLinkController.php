<?php

namespace App\Domain\Link\Controllers;

use App\Domain\Link\Contracts\Actions\DeleteLinkContract;
use App\Domain\Link\Requests\DeleteLinkRequest;
use App\Domain\Link\Requests\UpdateLinkRequest;
use App\Infrastructure\Abstracts\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

class DeleteLinkController extends Controller
{
    /**
     * @param int                $id
     * @param UpdateLinkRequest  $request
     * @param DeleteLinkContract $action
     *
     * @return Response
     */
    public function __invoke(
        int $id,
        DeleteLinkRequest $request,
        DeleteLinkContract $action
    ): Response {
        try {
            $isSuccess = $action->__invoke($id);

            if ($isSuccess) {
                return response(['status' => 'success']);
            }

            return response(['status' => 'failure'], 400);
        } catch (ModelNotFoundException) {
            abort(404);
        }
    }
}
