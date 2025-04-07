<?php

namespace App\Domain\Link\Controllers;

use App\Domain\Link\Contracts\Actions\CreateLinkContract;
use App\Domain\Link\Requests\CreateLinkRequest;
use App\Infrastructure\Abstracts\Controllers\Controller;
use Illuminate\Http\Response;

class CreateLinkController extends Controller
{
    /**
     * @param CreateLinkRequest $request
     * @param CreateLinkContract $action
     *
     * @return Response
     */
    public function __invoke(
        CreateLinkRequest $request,
        CreateLinkContract $action
    ): Response {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $link = $action->__invoke($data);
        return response($link, 201);
    }
}
