<?php

namespace Modules\Core\Traits\Repositories;

trait HasFind
{
    /**
     * retrieve the selected record from the database by Id
     *
     * @param int $id
     */
    public function byId($id)
    {
        return $this->model::where('id', $id)->first();
    }
}
