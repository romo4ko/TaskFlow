<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name',
        'description',
        'project_id',
        'parent_id',
        'status',
        'done',
        'type',
        'date_start',
        'date_end'
    ];
    public static $statuses = [
        0 => 'Новая',
        1 => 'Назначена',
        3 => 'В работе',
        4 => 'Проверка',
        5 => 'Завершена',
        6 => 'На исправлении',
    ];

    public static $types = [
        0 => 'Аналитика',
        1 => 'Разработка',
        3 => 'Тестирование',
    ];

    use HasFactory;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function parent()
    {
        return $this->belongsTo(Task::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getStatus()
    {
        return [
            'id' => $this->status,
            'name' => self::$statuses[$this->status]
        ];
    }

    public function getType()
    {
        if (!$this->type) {
            return null;
        }
        return [
            'id' => $this->type,
            'name' => self::$types[$this->type]
        ];
    }
}
