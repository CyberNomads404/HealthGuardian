<?php

namespace App\Http\Controllers;

use App\Models\BloodPressure;
use App\Models\DietaryHabit;
use App\Models\HeartRate;
use App\Models\PhysicalActivity;
use App\Models\Register;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\RegisterResource;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = User::find(auth()->user()->id);

        if ($user->hasProfile("person")) {
            return Register::where("user_id", $user->id)->get()->load("register");
        }

        if(isset($request->user_id)){
            return Register::where("user_id", $request->user_id)->get()->load("register");
        }

        return Register::all()->load("register");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        $user = User::find(auth()->user()->id);

        $polymorphicModels = [
            HeartRate::class,
            BloodPressure::class,
            PhysicalActivity::class,
            DietaryHabit::class,
        ];

        $register_type = $polymorphicModels[$request->type]::create($request->validated());
        $register = $user->registers()->create([
            "date" => $request->date,
            "register_type" => $polymorphicModels[$request->type],
            "register_id" => $register_type->id,
        ]);

        return new RegisterResource($register);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find(auth()->user()->id);
        $register = null;

        if ($user->hasProfile("person")) {
            $register = Register::where("user_id", $user->id)->find($id);
        }
        else{
            $register = Register::find($id);
        }

        if ($register) {
            return $register->load("register");
        }
        else{
            return response()->json(
                [
                    "errors" => [
                        'notfound' => 'Register Not Found'
                    ],
                ],
                404
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find(auth()->user()->id);
        $register = null;

        if ($user->hasProfile("person")) {
            $register = Register::where("user_id", $user->id)->find($id);
        }
        else{
            $register = Register::find($id);
        }

        if ($register) {
            $register->update($request->only("date"));
            $register->register->update($request->all());
            return response()->json(
                [
                    "data" => [
                        'message' => 'Successfully Update Register'
                    ],
                ],
                204
            );
        }
        else{
            return response()->json(
                [
                    "errors" => [
                        'notfound' => 'Register Not Found'
                    ],
                ],
                404
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find(auth()->user()->id);
        $register = null;

        if ($user->hasProfile("person")) {
            $register = Register::where("user_id", $user->id)->find($id);
        }
        else{
            $register = Register::find($id);
        }

        if ($register) {
            $register->delete();
            return response()->json(
                [
                    "data" => [
                        'message' => 'Successfully Delete Register'
                    ],
                ],
                204
            );
        }
        else{
            return response()->json(
                [
                    "errors" => [
                        'notfound' => 'Register Not Found'
                    ],
                ],
                404
            );
        }
    }
}
