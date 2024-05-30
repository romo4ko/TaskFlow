<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        Comment::create([
            'text' => $request->text,
            'task_id' => $request->task_id,
            'user_id' => $user->id
        ]);

        return ['status' => 0];
    }

    public function index(Request $request)
    {
        $comments = Comment::where('task_id', $request->task_id)
            ->join('users', 'task_comments.user_id', 'users.id')
            ->get();

        return $comments;
    }
}
