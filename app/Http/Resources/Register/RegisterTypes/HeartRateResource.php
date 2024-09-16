<?php

namespace App\Http\Resources\Register\RegisterTypes;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HeartRateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            'heart_rate' => $this->heart_rate,
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
