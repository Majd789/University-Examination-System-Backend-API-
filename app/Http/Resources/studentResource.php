<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class studentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

//            'id_student' => $this->id_student,
//            'first_name' => $this->first_name,
//            'last_name' => $this->last_name,

        ];
    }
}
