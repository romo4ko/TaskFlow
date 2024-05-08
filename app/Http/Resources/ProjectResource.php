<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'        => $this->name,
            'description' => $this->description,
            'extended'    => $this->extended,
            'status'      => $this->status,
            'pm'          => $this->pm,
            'date_start'  => $this->date_start,
            'date_end'    => $this->date_end,
        ];
    }
}
