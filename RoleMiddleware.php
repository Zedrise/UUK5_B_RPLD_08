<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $roles
     * @return mixed
     */
    public function handle($request, Closure $next, string $roles)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silahkan login terlebih dahulu.');
        }

        // Pisahkan roles yang dipisahkan koma
        $roleArray = explode(',', $roles);

        // Jika role user tidak ada di array
        if (!in_array(Auth::user()->role, $roleArray)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
