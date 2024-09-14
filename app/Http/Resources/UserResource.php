<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $gender = [
            ["Masculino", "M"],
            ["Feminino", "F"],
        ];

        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "date_birthday" => $this->date_birthday,
            "date_birthday_format" => Carbon::parse($this->date_birthday)->format('d/m/Y'),
            "gender" => [
                "name" => $gender[$this->gender][0],
                "reference" => $gender[$this->gender][1]
            ],
            "profile" => $this->profile->name,
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
