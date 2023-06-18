<?php
namespace Modules\Core\Traits\Repositories;

trait HasCreate
{
    /**
     * create a new record in database by providing details
     *
     * @param array $data
     */
    public function create($data)
    {
        return $this->model::create($data);
    }
}
