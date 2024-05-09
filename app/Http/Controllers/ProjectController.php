<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProjectResource::collection(Project::all());
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
