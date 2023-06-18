<?php
namespace Modules\Core\Traits\Repositories;

use Illuminate\Database\Eloquent\Model;

trait HasCreate
{
    /**
     * create a new record in database by providing details
     *
     * @param $data
     * @return mixed
     */
    public function create($data): Model
    {
        return $this->model::create($data);
    }
}
