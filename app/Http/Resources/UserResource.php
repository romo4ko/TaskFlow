<?php

namespace App\Http\Resources;

use App\Models\Job;
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
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'email'       => $this->email,
            'phone'       => $this->phone,
            'job'         => $this->job,
            'grants'      => $this->getGrants(),
            'created_at'  => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }

    public function getGrants()
    {
        $slug = array_search($this->job->grants, Job::$grants);
        $name = match ($slug) {
            'administrator' => 'Директор',
            'manager' => 'Менеджер',
            default => 'Пользователь',
        };

        return [
            'slug' => $slug,
            'name' => $name
        ];
    }
}
