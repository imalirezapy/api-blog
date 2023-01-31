<?php

namespace App\Http\Controllers\Api;

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

    protected function uploadFile(Request $request)
    {
        $filenameWithExt = $request->file('profile')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $filename = \hash('sha256', $filename . now()->timestamp);

        $extension = $request->file('profile')->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;

        $path = $request->file('profile')->storeAs('images',$fileNameToStore);
        return $fileNameToStore;
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);


        if ($request->hasFile('profile')) {
            $profile = $this->uploadFile($request);
            $validated['profile'] = $profile;
        }

        $token = $this->repository->create($validated)->createToken();

        return response()->json([
            'message' => 'Token generated',
            'data' => [
                'token' => $token
            ]
        ], Response::HTTP_OK);
    }

    public function login(LoginUserRequest $request)
    {
        $credentials =  $request->only('email', 'password');

        if (!$user = $this->repository->attempt($credentials, 'email')) {
            throw new HttpResponseException(response()->json([
                'message' => 'Validation errors',
                'data' => [
                    'email' => ['Email or Password is wrong!']
                ],
            ], Response::HTTP_BAD_REQUEST));
        }

        return response()->json([
            'message' => 'New Token generated.',
            'data' => [
                'token' => $user->createToken()
            ]
        ], Response::HTTP_OK);
    }
}
