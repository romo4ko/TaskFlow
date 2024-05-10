<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Http\Resources\UserResource;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\Controllers\AuthController;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        $auth = $user->auth();
        if ($auth['role'] == 'administrator') {
            $projects = Project::all();
        }
        elseif ($auth['role'] == 'manager') {
            $projects = Project::where('pm_id', $auth['user']->id)->get();
        }
        else {
            // Проекты, с задачами, за которыми закреплён сотрудник
            $projects = Project::query()
                ->join('tasks', 'tasks.project_id', 'projects.id')
                ->join('user_task', 'user_task.task_id', 'tasks.id')
                ->select('projects.*')
                ->where('user_task.employee_id', $auth['user']->id)
                ->distinct()
                ->get();
        }

        return ProjectResource::collection($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $projects): \Illuminate\Http\Response | array
    {
        $request->validate([
           'name' => 'required',
           'pm_id' => 'required',
        ]);
        $projects->create(
              $request->only([
                 'name',
                 'description',
                 'extended',
                 'status',
                 'pm_id',
                 'date_start',
                 'date_end'
             ])
        );
        return ['status' => 0];
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project): \Illuminate\Http\Response | array
    {
        $project->update(
            $request->only([
                'name',
                'description',
                'extended',
                'status',
                'pm_id',
                'date_start',
                'date_end'
            ])
        );
        return ['status' => 0];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
    }

    public function getFormData(Project $project, User $user)
    {
        return [
            'statuses' => $project::$statuses,
            'managers' => $user->menegers()
        ];
    }
}
