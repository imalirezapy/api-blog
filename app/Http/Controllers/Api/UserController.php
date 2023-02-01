<?php

namespace App\Http\Controllers\Api;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private UserRepositoryInterface $repository;
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    public function index()
    {
        dd('okey');
    }


    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('profile')) {
            $validated['profile'] = Helper::uploadImage($request, 'profile');
        }

        $token = $this->repository->create($validated)->createToken();

        return Helper::responseJson(
            data: ['token' => $token],
            message: 'Token generated successfully.'
        );
    }


    public function login(LoginUserRequest $request)
    {
        $credentials =  $request->only('email', 'password');
        $user = $this->repository->attempt($credentials, 'email');

        if (!$user->get()) {
            Helper::abortJson(Response::HTTP_BAD_REQUEST);
        }

        return Helper::responseJson(
            data: ['token' => $user->createToken()],
            message: 'New Token generated.'
        );
    }
}
