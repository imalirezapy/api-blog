<?php

namespace App\Exceptions\Api;

use App\Composables\Responses\Features\ThrowsNotFound;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class ApiNotFoundExceptionHandler extends ExceptionHandler
{
    use ThrowsNotFound;

    public function render($request, Throwable $e)
    {
        $this->notFound();
    }
}
