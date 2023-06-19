<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Core\Contracts\Controllers\CrudComponentInterface;
use Modules\Core\Traits\Controllers\CrudComponent\Destroys;
use Modules\Core\Traits\Controllers\CrudComponent\HasIndex;
use Modules\Core\Traits\Controllers\CrudComponent\HasParametricIndex;
use Modules\Core\Traits\Controllers\CrudComponent\Shows;
use Modules\Core\Traits\Controllers\CrudComponent\ShowsBy;
use Modules\Core\Traits\Controllers\CrudComponent\ShowsBySlug;
use Modules\Core\Traits\Controllers\CrudComponent\Stores;
use Modules\Core\Traits\Controllers\CrudComponent\Updates;

class CrudComponent extends ApiController implements CrudComponentInterface
{
    use Shows,
        ShowsBy,
        ShowsBySlug,
        Stores,
        Updates,
        Destroys,
        HasParametricIndex,
        HasIndex;


    public function __construct(
        public $repository,
        public readonly string  $resourceClass,
        public readonly string $notFoundMessage,
    ) { }
}
