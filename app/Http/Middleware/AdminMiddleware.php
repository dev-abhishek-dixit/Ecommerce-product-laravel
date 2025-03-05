<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $permission=$user->HasPermission('/'.$request->path());
        // $role=Role::with('permission')->find($user);
        return response($permission);
        // if ($role == 'Admin' || $role == 'Manager') {
        //     return $next($request);
        // } 
        // abort(403, 'Unauthorized');
    }
}
