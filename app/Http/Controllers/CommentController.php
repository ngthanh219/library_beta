<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        Comment::create($data);

        return response()->json([
            'user_name' => Auth::user()->name,
            'comment' => $data['comment'],
            'status' => 'success',
        ]);
    }
}
