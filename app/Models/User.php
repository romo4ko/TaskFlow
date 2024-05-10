<?php

declare(strict_types=1);

namespace App\Models;

use App\Http\Resources\UserResource;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'job_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function menegers()
    {
        return $this->select('users.*')
            ->join('jobs', 'job_id', 'jobs.id')
            ->where('jobs.grants', Job::$grants['manager'])
            ->orWhere('jobs.grants', Job::$grants['administrator'])
            ->get();
    }

    public function employees()
    {
        return $this->all();
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function auth()
    {
        $user = Auth::user();
        if ($user) {
            return [
                'user' => $user,
                'role' => array_search($this->find($user->id)->job->grants, Job::$grants)
                ];
        }
        return null;
    }


}
