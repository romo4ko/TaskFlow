<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $jobs = [
            [
                'name' => 'Директор',
                'grants' => Job::$grants['administrator']
            ],
            [
                'name' => 'Менеджер',
                'grants' => Job::$grants['manager']
            ],
            [
                'name' => 'Фронтенд-разработчик',
                'grants' => Job::$grants['employee']
            ],
            [
                'name' => 'Бекенд-разработчик',
                'grants' => Job::$grants['employee']
            ],
            [
                'name' => 'Аналитик',
                'grants' => Job::$grants['employee']
            ],
        ];

        foreach ($jobs as $job) {
            Job::query()->create($job);
        }

        User::query()->create(
            [
                'name'     => 'admin',
                'email'    => 'admin@admin.ru',
                'job_id'   => Job::where('grants', Job::$grants['administrator'])->first()->id,
                'password' => Hash::make('password'),
            ]
        );

        foreach (range(0, 5) as $index) {
            User::query()->create([
                  'name' => fake()->name,
                  'email'    => fake()->email,
                  'job_id'   => Job::where('grants', fake()->randomElements([
                        Job::$grants['manager'],
                        Job::$grants['employee'],
                  ]))->first()->id,
                  'password' => Hash::make('password'),
            ]);
        }

        Project::query()->create([
             'name' => 'Проект 1',
             'description' => 'Описание проекта 1',
             'extended' => 'Дополнительное описание проекта 1',
             'pm_id' => User::query()->first()->id,
             'date_start' => Carbon::now()
        ]);

        foreach (range(0, 5) as $index) {
            Task::query()->create([
                  'name' => 'Задача '.$index,
                  'description' => 'Описание задачи '.$index,
                  'project_id' => Project::query()->first()->id,
                  'date_start' => Carbon::now(),
            ]);
        }
    }
}
