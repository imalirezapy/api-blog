<?php

namespace Modules\Core\Traits\Repositories;

use Illuminate\Database\Eloquent\Model;

trait HasUpdate
{
    /**
     * update an existing record in database
     *
     * @param Model $model
     * @param array $newData
     */
    public function update($model, $newData)
    {
        $model->update($newData);

        return $model;
    }
}
