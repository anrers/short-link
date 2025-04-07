<?php

namespace App\Domain\Auth\Controllers;

use App\Domain\Auth\Contracts\Actions\SignOutContract;
use App\Infrastructure\Abstracts\Controllers\Controller;
use Illuminate\Http\Response;

class SignOutController extends Controller
{
    public function __invoke(SignOutContract $action): Response
    {
        $action->__invoke();
        return response(['status' => 'success']);
    }
}
