<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
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
        //未登录从新定向至登陆页面
        if(!session('admin'))
        {
            return redirect('admin/login');
        }

        return $next($request);
    }
}
