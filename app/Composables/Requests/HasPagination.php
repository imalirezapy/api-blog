<?php

namespace App\Composables\Requests;

trait HasPagination
{
    public function perPage(): string|int|null
    {
        return $this->validated('perPage');
    }
}
