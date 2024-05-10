<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user): \Illuminate\Http\Response | array
    {
        $request->validate([
                               'name' => 'required',
                               'job_id' => 'required',
                               'email' => 'required',
                               'password' => 'required',
                           ]);
        $user->create([
                               'name' => $request->name,
                               'email' => $request->email,
                               'phone' => $request->phone,
                               'job_id' => $request->job_id,
                               'password' => Hash::make($request->password),
        ]);

        return ['status' => 0];
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): \Illuminate\Http\Response | array
    {
        $request->validate([
                               'name' => 'required',
                               'job_id' => 'required',
                               'email' => 'required',
                           ]);
        if ($request->password != null) {
            $user->update([
                              'name' => $request->name,
                              'phone' => $request->phone,
                              'job_id' => $request->job_id,
                              'email' => $request->email,
                              'password' => Hash::make($request->password),
                          ]);
        }
        else {
            $user->update([
                              'name' => $request->name,
                              'phone' => $request->phone,
                              'job_id' => $request->job_id,
                              'email' => $request->email,
                          ]);
        }

        return ['status' => 0];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
    }

    public function getFormData()
    {
        return [
            'jobs' => Job::all(),
        ];
    }
}
