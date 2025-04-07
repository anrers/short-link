<?php

namespace App\Domain\Link\Actions;

use App\Domain\Link\Contracts\Actions\GetLinkByCodeContract;
use App\Domain\Link\Models\Link;
use App\Domain\Link\Repositories\LinkRepository;

class GetLinkByCodeAction implements GetLinkByCodeContract
{
    protected int $maxAttempts = 5;

    public function __construct(
        protected LinkRepository $linkRepository,
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
