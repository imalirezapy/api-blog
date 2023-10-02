<?php

namespace App\Data\DTO;

use App\Composables\DTO\HintForFromDTO;
use DragonCode\SimpleDataTransferObject\DataTransferObject;
use Illuminate\Support\Carbon;

class UserDTO extends DataTransferObject
{
    use HintForFromDTO;

    public string|null $first_name = null;
    public string|null $last_name = null;
    public string|null $email = null;
    public Carbon|string|null $email_verified_at = null;
    public ?string $password = null;
    public ?string $avatar = null;
    public ?string $avatar_relative = null;
    public Carbon|string|null $created_at = null;
    public Carbon|string|null $updated_at = null;
    public Carbon|string|null $deleted_at = null;
}
