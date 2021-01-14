<?php

namespace App\Http\Middleware;

use App\Models\Request;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()) {
            $user = User::findOrFail(Auth::id())->load(['requests' => function ($query) {
                $query->where('status', '<>', 2)->where('status', '<>', 4)->where('status', '<>', 5)->where('status', '<>', 6   );
            }]);
            $status = $user->status;
            foreach ($user->requests as $item) {
                $returnDate = Carbon::parse($item->return_date);
                $today = Carbon::today();
                $date = $returnDate->lt($today);
                if ($date) {
                    if ($item->status == 0 || $item->status == 1) {
                        $req = Request::findOrFail($item->id)->load('user');
                        foreach ($req->books as $book) {
                            $book->update([
                                'in_stock' => $book->in_stock + 1,
                            ]);
                        }
                        $user->update([
                            'status' => $status + 1,
                        ]);
                        $req->update([
                            'status' => 6,
                        ]);
                    } else {
                        $req = Request::findOrFail($item->id)->load('user');
                        $user->update([
                            'status' => $status + 1,
                        ]);
                        $req->update([
                            'status' => 5,
                        ]);
                    }
                }
            }
        }

        if (Auth::user()->role_id == 1) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
