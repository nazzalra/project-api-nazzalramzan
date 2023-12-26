<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function store(UserStoreRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return new UserResource($user);
    }

    public function index()
    {
        $users = User::paginate(10);
        return UserResource::collection($users);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(User $user,Request $request)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|unique:users,email,'.$user->id
        ]);

        $user->update($validated);

        return new UserResource($user);
    }

    public function updatePassword(User $user, Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => ['required','confirmed', Password::defaults()]
        ]);

        if(!Hash::check($request->current_password, $user->password)){
            throw ValidationException::withMessages([
                'error' => 'The provided credentials are not correct'
            ]);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Password updated successfully'
        ], Response::HTTP_OK);
    }
}
