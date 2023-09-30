<?php

namespace App\Enums;

use ArchTech\Enums\Values;

enum CommentStatusesEnum: string
{
    use Values;

    case PENDING = 'pending';
    case REJECTED = 'rejected';
    case APPROVED = 'approved';
}
