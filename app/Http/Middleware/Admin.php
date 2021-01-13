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
                $query->where('status', '<>', 2)->where('status', '<>', 4)->where('status', '<>', 5);
            }]);
            $status = $user->status;
            foreach ($user->requests as $item) {
                $returnDate = Carbon::parse($item->return_date);
                $today = Carbon::today();
                $date = $returnDate->lt($today);
                if ($date) {
                    if ($status == 0 || $status == 1) {
                        dd('Yess');
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
