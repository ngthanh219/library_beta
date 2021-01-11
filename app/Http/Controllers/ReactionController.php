<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Auth;

class ReactionController extends Controller
{
    public function react($bookId)
    {
        $user = Auth::user();
        $likes = Like::where('user_id', $user->id)->where('book_id', $bookId)->first();
        $book_like = Like::where('book_id', $bookId)->get();

        if (!$likes) {
            $item = Like::create([
                'user_id' => $user->id,
                'book_id' => $bookId,
                'status' => 1
            ]);

            return response()->json([
                'count' => $book_like->count(),
                'like' => true,
            ]);
        } else {
            if ($likes->status == 1) {
                $likes->update([
                    'user_id' => $user->id,
                    'book_id' => $bookId,
                    'status' => null
                ]);

                return response()->json([
                    'count' => $book_like->count(),
                    'like' => false,
                ]);
            } else if ($likes->status == null) {
                $likes->update([
                    'user_id' => $user->id,
                    'book_id' => $bookId,
                    'status' => 1
                ]);

                return response()->json([
                    'count' => $book_like->count() - 1,
                    'like' => true,
                ]);
            }
        }
    }
}
