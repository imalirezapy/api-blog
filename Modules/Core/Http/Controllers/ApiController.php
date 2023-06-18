<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\Controllers\ApiResponseFormatter;

class ApiController extends Controller
{
    use ApiResponseFormatter;
}
