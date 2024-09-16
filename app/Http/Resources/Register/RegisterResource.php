<?php

namespace App\Http\Resources\Register;

use App\Http\Resources\Register\RegisterTypes\BloodPressureResource;
use App\Http\Resources\Register\RegisterTypes\DietaryHabitResource;
use App\Http\Resources\Register\RegisterTypes\HeartRateResource;
use App\Http\Resources\Register\RegisterTypes\PhysicalActivityResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $register = [];

        if($this->register_type == "App\\Models\\BloodPressure") {
            $register = new BloodPressureResource($this->register);
        } else if($this->register_type == "App\\Models\\DietaryHabit") {
            $register = new DietaryHabitResource($this->register);
        } else if($this->register_type == "App\\Models\\HeartRate") {
            $register = new HeartRateResource($this->register);
        } else if($this->register_type == "App\\Models\\PhysicalActivity") {
            $register = new PhysicalActivityResource($this->register);
        }

        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "register_type" => $this->register_type,
            "register_id" => $this->register_id,
            "date" => $this->date,
            "date_format" => [
                "date" => Carbon::parse($this->date)->format('d/m/Y'),
                "time" => Carbon::parse($this->date)->format('H:i'),
            ],
            "register" => $register,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "created_at_format" => [
                "date" => Carbon::parse($this->created_at)->format('d/m/Y'),
                "time" => Carbon::parse($this->created_at)->format('H:i'),
            ],
            "updated_at_format" => [
                "date" => Carbon::parse($this->updated_at)->format('d/m/Y'),
                "time" => Carbon::parse($this->updated_at)->format('H:i'),
            ],
        ];
    }
}
