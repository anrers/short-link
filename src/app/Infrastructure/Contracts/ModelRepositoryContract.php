<?php

namespace App\Infrastructure\Contracts;

use Illuminate\Database\Eloquent\Model;

/**
 * @template MClass
 */
interface ModelRepositoryContract
{
    /**
     * @param array $data
     *
     * @return MClass
     */
    public function create(array $data): Model;

    /**
     * @param int   $id
     * @param array $data
     *
     * @return MClass
     */
    public function update(int $id, array $data): Model;

    public function delete(int $id): bool;

    /**
     * @return MClass
     */
    public function getModelObject(): Model;
}
