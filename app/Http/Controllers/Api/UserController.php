<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index()
    {
        dd('okey');
    }

    protected function uploadFile(Request $request)
    {
        $filenameWithExt = $request->file('profile')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $filename = str_replace(
            ['$', '/', '.'],
            '',
            Hash::make($filename. now()->timestamp)
        );
        $extension = $request->file('profile')->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;

        $path = $request->file('profile')->storeAs('images',$fileNameToStore);
        return $fileNameToStore;
    }

    public function store(StoreUserRequest $request)
    {
        if ($request->hasFile('profile')) {
            $profile = $this->uploadFile($request);
        }

        $validated = $request->validated();
        $validated['profile'] = $profile ?? null;

        $user = User::create($validated);

        $token = $user->createToken($user->email)->plainTextToken;

        return response()->json([
            'message' => 'Token created',
            'data' => [
                'token' => $token
            ]
        ], Response::HTTP_OK);
    }
}
