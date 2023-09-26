<?php

namespace Tests;

trait ResponseMetaStructure
{
    private array $responsePaginatedStructure = [
        'meta' => [
            'current_page',
            'from',
            'path',
            'per_page',
            'to',
        ],
        'links' => [
            'first',
            'last',
            'prev',
            'next',
        ],
    ];

    private array $responseMessageStructure = [
        'message_alias',
        'message',
    ];

    private array $responseMessageFulDataStructure = [
        'message_alias',
        'message',
        'data',
    ];
}
