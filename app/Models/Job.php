<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
      'name',
      'grants'
    ];

    public static $grants = [
        'administrator' => 1,
        'manager' => 2,
        'employee' => 3
    ];

    use HasFactory;
}
