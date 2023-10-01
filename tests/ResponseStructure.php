<?php
namespace Tests;

trait ResponseStructure
{
    protected array $responseStructure = [
        'status_code',
        'message',
        'is_successful',
        'data',
        'extra',
    ];
}
