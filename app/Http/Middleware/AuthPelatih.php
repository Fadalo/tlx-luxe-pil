<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Instructor\Instructor;
class AuthPelatih
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       

        if(Auth::guard('instructor')->check()){
            $id = Auth::guard('instructor')->User()->id;
            $Instructor = Instructor::find($id);
            if ($Instructor){
                if($Instructor->status_instructor == 0)
                {
                    return redirect('/instructor/lock');
                }
            }
        }
        else if (!Auth::guard('instructor')->check()) {
            
            return redirect('/instructor/login');
        }
        return $next($request);
    }
}
