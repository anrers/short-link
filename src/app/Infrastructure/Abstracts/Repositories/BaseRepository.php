<?php

namespace App\Infrastructure\Abstracts\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * @template MClass
 */
abstract class BaseRepository
{
    abstract public function getModelClass(): string;

    /**
     * @return MClass
     */
    public function getModelObject(): Model
    {
        $class = $this->getModelClass();
        return new $class();
    }

    /**
     * @param array $data
     *
     * @return MClass
     */
    public function create(array $data): Model
    {
        $model = $this->getModelObject()->fill($data);
        $model->save();
        return $model;
    }

    /**
     * @param int   $id
     * @param array $data
     *
     * @return MClass
     */
    public function update(int $id, array $data): Model
    {
        $model = $this->getModelObject()->findOrFail($id);
        $model->fill($data);
        $model->save();
        return $model;
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->getModelObject()->findOrFail($id)->delete();
    }
}
