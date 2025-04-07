<?php

namespace App\Domain\Link\Actions;

use App\Domain\Link\Contracts\Actions\GetLinkByCodeContract;
use App\Domain\Link\Contracts\Repositories\LinkRepositoryContract;
use App\Domain\Link\Models\Link;

class GetLinkByCodeAction implements GetLinkByCodeContract
{
    public function __construct(
        protected LinkRepositoryContract $linkRepository,
    ) {
    }

    public function __invoke(string $code): Link
    {
        $partition = substr($code, 0, 1);
        return $this->linkRepository
            ->getModelObject()
            ->where('partition', $partition)
            ->where(['code' => $code])
            ->firstOrFail();
    }
}
