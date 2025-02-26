<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/'); // Chuyển hướng về trang chủ nếu chưa đăng nhập
        }

        $user = Auth::user();

        if ($user->role !== $role && $user->role !== 'admin') {
            return redirect('/'); // Chuyển hướng về trang chủ nếu không có quyền
        }

        return $next($request);
    }
}
