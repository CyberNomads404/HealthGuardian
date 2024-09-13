<?php

namespace App\Http\Controllers;

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
                    "msg" => "Authorized",
                    "token" => $request->user()->createToken('login')->plainTextToken
                ]
            ], 200);
        }
        return response()->json('Not Authorized', 403);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json('Token Revoked', 200);
    }

    public function register(Request $request)
    {
        $request['password'] = bcrypt($request->password);
        User::create($request->only('name', 'email', 'password', "date_birthday", "gender"));

        return response()->json('User Created', 201);
    }

    public function profile()
    {
        return auth()->user();
    }

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
