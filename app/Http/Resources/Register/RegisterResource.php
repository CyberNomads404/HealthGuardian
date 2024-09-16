<?php

namespace App\Http\Resources\Register;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'register_type' => class_basename($this->register_type), // Retorna o nome da classe (HeartRate, BloodPressure, etc.)
            'register' => $this->whenLoaded('register', function () {
                return $this->register->toArray();
            }),
            'user' => new UserResource($this->whenLoaded('user')), // Inclui os dados do usuário, caso carregados
        ];
    }
}
