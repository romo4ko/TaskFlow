<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, User $user)
    {
        $auth = $user->auth();
        $project_id = $request->get('project_id');

        if ($project_id) {

            if ($auth['role'] == 'administrator') {
                $tasks = Task::where('project_id', $project_id)->get();
            }
            elseif ($auth['role'] == 'manager') {
                $tasks = Task::where('project_id', $project_id)->get();
            }
            else {
                // Проекты, с задачами, за которыми закреплён сотрудник
                $tasks = Task::query()
                    ->join('user_task', 'user_task.task_id', 'tasks.id')
                    ->select('tasks.*')
                    ->where('user_task.employee_id', $auth['user']->id)
                    ->where('project_id', $project_id)
                    ->distinct()
                    ->get();
            }

            return TaskResource::collection($tasks);
        }

        return null;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Task $task): \Illuminate\Http\Response | array
    {
        $request->validate([
                               'name' => 'required',
                               'project_id' => 'required',
                               'done' => 'integer|min:0|max:100'
                           ]);
        $id = $task->create(
            $request->only([
                               'name',
                               'description',
                               'project_id',
                               'parent_id',
                               'status',
                               'done',
                               'type',
                               'date_start',
                               'date_end'
                           ])
        )->id;

        $employee_ids = $request->get('employee_ids');
        if ($employee_ids) {
            foreach ($employee_ids as $employee_id) {
                DB::table('user_task')->insert([
                                'employee_id' => $employee_id,
                                'task_id' => $id
               ]);
            }
        }

        return ['status' => 0];
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
               'name' => 'required',
               'project_id' => 'required',
                'done' => 'integer|min:0|max:100'
           ]);
        $task->update(
            $request->only([
               'name',
               'description',
               'project_id',
               'parent_id',
               'status',
               'done',
               'type',
               'date_start',
               'date_end'
            ])
        );

        $employee_ids = $request->get('employee_ids');
        if ($employee_ids) {
            DB::table('user_task')->where('task_id', $task->id)->delete();
            foreach ($employee_ids as $employee_id) {
                DB::table('user_task')->insert([
                   'task_id' => $task->id,
                   'employee_id' => $employee_id
                ]);
            }
        }

        return ['status' => 0];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
    }

    public function getFormData(Task $task, User $user, ProjectController $projectController)
    {
        return [
            'statuses' => $task::$statuses,
            'types' => $task::$types,
            'employees' => $user->employees(),
            'projects' => $projectController->index($user)
        ];
    }
}
