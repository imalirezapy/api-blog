<?php

namespace App\Enums;

use ArchTech\Enums\Values;

enum ArticleStatusesEnum: string
{
    use Values;

    case DRAFTED = 'drafted';
    case ARCHIVED = 'archived';
    case PROPOSED = 'proposed';
    case PUBLISHED = 'published';
}
