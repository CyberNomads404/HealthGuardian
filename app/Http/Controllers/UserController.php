<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\Admin\UserStoreRequest;
use App\Http\Requests\Users\Admin\UserUpdateRequest;
use App\Http\Requests\Users\EditProfileRequest;
use App\Http\Requests\Users\LoginRequest;
use App\Http\Requests\Users\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                "data" => [
                    "message" => "Authorized",
                    "token" => $request->user()->createToken('login')->plainTextToken
                ]
            ], 200);
        }

        return response()->json(
            [
                "errors" => [
                    'message' => 'Not Authorized'
                ],
            ],
            403
        );
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->json(
            [
                "data" => [
                    'message' => 'Token was Revoked'
                ],
            ],
            200
        );
    }

    public function register(RegisterRequest $request)
    {
        $request['password'] = bcrypt($request->password);
        $user = User::create($request->only('name', 'email', 'password', "date_birthday", "gender"));
        $user->assignProfile('person');

        return response()->json(
            [
                "data" => [
                    'message' => 'User Registered Successfully'
                ],
            ],
            201
        );
    }

    public function profile()
    {
        return new UserResource(User::find(auth()->user()->id)->load('profile'));
    }

    public function editProfile(EditProfileRequest $request)
    {
        $user = User::find(auth()->user()->id);

        if ($request->password) {
            $request['password'] = bcrypt($request->password);
            auth()->user()->currentAccessToken()->delete();
        }

        $user->update($request->only('name', 'password', "date_birthday", "gender"));

        return response()->json(
            [
                "data" => [
                    'message' => 'Successfully Edit User Profile'
                ],
            ],
            200
        );
    }

    // Admin + Doctor

    public function index()
    {
        $me = User::find(auth()->user()->id);
        $users = null;

        if ($me->hasProfile('admin')) {
            $users = User::all();
        } else if ($me->hasProfile('doctor')) {
            $users = User::where('profile_id', 3)->get();
        }

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $request['password'] = bcrypt($request->password);
        $user = User::create($request->only('name', 'email', 'password', "date_birthday", "gender"));
        $user->assignProfile($request->profile);

        return response()->json(
            [
                "data" => [
                    'message' => 'User Registered Successfully'
                ],
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $me = User::find(auth()->user()->id);
        $user = null;

        if ($me->hasProfile('admin')) {
            $user = User::find($id);
        } else if ($me->hasProfile('doctor')) {
            $user = User::where('profile_id', 3)->find($id);
        }

        if (!$user) {
            return response()->json(
                [
                    "errors" => ['NotFound' => 'User Not Found']
                ],
                404
            );
        }

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        if (!$user = User::find($id)) {
            return response()->json(
                [
                    "errors" => [
                        'NotFound' => 'User Not Found'
                    ],
                ],
                404
            );
        }

        if ($user->id == auth()->user()->id){
            return response()->json(
                [
                    "errors" => [
                        'MySelf' => 'User is you'
                    ],
                ],
                404
            );
        }

        if ($request->password) {
            $request['password'] = bcrypt($request->password);
            auth()->user()->currentAccessToken()->delete();
        }

        $user->update($request->only('name', 'password', "date_birthday", "gender"));
        $user->assignProfile($request->profile ?? '');

        return response()->json(
            [
                "data" => [
                    'message' => 'Successfully Edit User'
                ],
            ],
            204
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$user = User::find($id)) {
            return response()->json(
                [
                    "errors" => [
                        'NotFound' => 'User Not Found'
                    ],
                ],
                404
            );
        }

        if ($user->id == auth()->user()->id){
            return response()->json(
                [
                    "errors" => [
                        'MySelf' => 'User is you'
                    ],
                ],
                404
            );
        }

        $user->delete();

        return response()->json(
            [
                "data" => [
                    'message' => 'Successfully Delete User'
                ],
            ],
            204
        );
    }
}
