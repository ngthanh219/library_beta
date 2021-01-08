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

        if (!$likes) {
            $item = Like::create([
                'user_id' => $user->id,
                'book_id' => $bookId,
                'status' => 1
            ]);

            return response()->json([
                'count' => $item->count(),
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
                    'count' => $likes->count(),
                    'like' => false,
                ]);
            } else if ($likes->status == null) {
                $likes->update([
                    'user_id' => $user->id,
                    'book_id' => $bookId,
                    'status' => 1
                ]);

                return response()->json([
                    'count' => $likes->count(),
                    'like' => true,
                ]);
            }
        }

    }
}
