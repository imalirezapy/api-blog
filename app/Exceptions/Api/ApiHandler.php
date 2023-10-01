<?php

namespace App\Exceptions\Api;


use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class ApiHandler extends ExceptionHandler
{

    /**
     * register api exception mappings.
     */
    protected array $exceptionMapApi = [
        NotFoundHttpException::class => ApiNotFoundExceptionHandler::class,
    ];

    public function render($request, Throwable $e)
    {
        foreach ($this->exceptionMapApi as $fromException => $toException) {
            if ($e instanceof $fromException) {
                app($toException)->render($request, $e);
            }
        }
        return parent::render($request, $e);
    }
}
