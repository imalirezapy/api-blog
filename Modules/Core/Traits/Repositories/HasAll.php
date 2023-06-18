<?php

namespace Modules\Core\Traits\Repositories;

trait HasAll
{
    /**
     * retrieve all records from the database
     */
    public function all()
    {
        return $this->model::all();
    }
}
