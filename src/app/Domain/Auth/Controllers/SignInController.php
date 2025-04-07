<?php

namespace App\Domain\Auth\Controllers;

use App\Domain\Auth\Contracts\Actions\SignInContract;
use App\Domain\Auth\Requests\SignInRequest;
use App\Infrastructure\Abstracts\Controllers\Controller;
use Illuminate\Http\Response;

class SignInController extends Controller
{
    public function __invoke(
        SignInRequest $request,
        SignInContract $action
    ): Response {
        $isAuthSuccess = $action->__invoke($request->validated());
        if ($isAuthSuccess) {
            return response(['status' => 'success']);
        }

        return response([
            'status' => 'error',
            'message' => 'Credentials invalid',
        ], status: 400);
    }
}
