<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PresensiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'jam_in'        => $this->jam_in,
            'jam_out'       => $this->jam_out,
            'picture_in'    => $this->picture_in,
            'picture_out'   => $this->picture_out,
            'location_in'    => $this->location_in,
            'location_out'   => $this->location_out,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
            'student'       => new StudentResource($this->student)
        ];
    }
}
