<?php

namespace App\Http\Middleware;

use App\Services\MarketService;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }
        $user = Auth::guard()->user();

        $now = Carbon::now();

        $last_seen = Carbon::parse($user->last_seen_at);
        //dd($user->last_seen_at);
        $absence = $now->diffInMinutes($last_seen);
        //dd($absence,$user->last_seen_at);
        if ($absence > config('session.lifetime')) {
            $request->session()->invalidate();

            $request->session()->regenerateToken();
            $marketService = resolve(MarketService::class);
            $marketService->userLogout();

            //return redirect('/');

            return $next($request);
        }
        $user->last_seen_at = $now->format('Y-m-d H:i:s');
        $user->save();
        return $next($request);
    }
}
