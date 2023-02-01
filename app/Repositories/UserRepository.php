<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    public $user;
    public function create(array $details): self
    {
        $this->user = User::create($details);
        return $this;
    }

    public function attempt(array $credentials, string $primary_key): self|false
    {
        if (!Auth::attempt($credentials)) {
            return false;
        }

        $this->user = User::where($primary_key, $credentials[$primary_key])->first();

        return $this;
    }

    public function createToken(string $name = 'public'): string
    {
        return $this->user->createToken($name)->plainTextToken;
    }

    public function get()
    {
        return $this->user;
    }
}
