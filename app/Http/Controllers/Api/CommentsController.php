<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::tree()->orderBy('created_at', 'desc')->get()->toTree();
        return response()->json($comments, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'body' => 'required|string',
            'parent_id' => 'sometimes|nullable|integer|exists:comments,id',
        ]);

        if ($this->depthIsAllowed($request->parent_id) === false) {
            return response()->json([
                'message' => 'You can not reply to this comment',
            ], 422);
        }

        Comment::create($request->only(['name', 'body', 'parent_id']));

        return response()->json("", 201);
    }

    private function depthIsAllowed($parentId)
    {
        if ($parentId === null) {
            return true;
        }
        $paths = count(Comment::find($parentId)->ancestors()->pluck('path'));
        if ($paths <= 2) {
            return true;
        }
        return false;
    }
}
