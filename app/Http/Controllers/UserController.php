<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function login(Request $request)
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

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(
            [
                "data" => [
                    'message' => 'Token was Revoked'
                ],
            ],
            200
        );
    }

    public function register(Request $request)
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

    public function editProfile(Request $request)
    {
        $user = User::find(auth()->user()->id);

        if ($request->password) {
            $request['password'] = bcrypt($request->password);
            auth('api')->logout();
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
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
