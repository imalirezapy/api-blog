<?php

namespace App\Interfaces;

use App\Models\User;
use Monolog\Handler\FingersCrossed\ActivationStrategyInterface;

interface UserRepositoryInterface
{
    public function create(array $details): self;
    public function attempt(array $credentials, string $primary_key): self|false;

    public function createToken(string $name): string;

}
