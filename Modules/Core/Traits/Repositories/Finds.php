<?php

namespace Modules\Core\Traits\Repositories;

trait Finds
{
    /**
     * retrieve a single record from the repository
     *
     */
    public function find($id)
    {
        return $this->model::where('id', $id)->first();
    }
}
