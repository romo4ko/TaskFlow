<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'extended',
        'status',
        'pm_id',
        'date_start',
        'date_end'
    ];

    public static $statuses = [
        0 => 'Планруется',
        1 => 'В работе',
        3 => 'Завершён',
        4 => 'Отменён',
    ];

    public function pm()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatus()
    {
        return [
            'id' => $this->status,
            'name' => self::$statuses[$this->status]
        ];
    }
}
