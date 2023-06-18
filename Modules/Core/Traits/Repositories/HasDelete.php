<?php

namespace Modules\Core\Traits\Repositories;

trait HasDelete
{
    /**
     * remove an existing record from database
     *
     * @param int $id
     */
    public function delete($id)
    {
        return $this->model::destroy($id);
    }
}
