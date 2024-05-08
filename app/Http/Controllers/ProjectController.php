<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
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
    public function store(Request $request, Project $projects)
    {
//        $request->all()
        $projects->append([
          'name'        => $request->name,
          'description' => $request->description ?? null,
          'extended'    => $request->extended ?? null,
          'status'      => $request->status,
          'pm'          => $request->pm,
          'date_start'  => $request->date_start,
          'date_end'    => $request->date_end ?? null,
      ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
//        route()->get()
//        $project->find()
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $project->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
    }
}
