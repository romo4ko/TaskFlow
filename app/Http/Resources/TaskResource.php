<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'project'     => $this->project,
            'parent'      => $this->parent,
            'status'      => $this->getStatus(),
            'done'        => $this->done,
            'type'        => $this->getType(),
            'date_start'  => $this->date_start,
            'date_end'    => $this->date_end,
        ];
    }
}
