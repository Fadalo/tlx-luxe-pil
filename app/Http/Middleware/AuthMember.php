<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Member\Member;
class AuthMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       
       
        if(Auth::guard('member')->check()){
            $id = Auth::guard('member')->User()->id;
            $Member = Member::find($id);
            if ($Member){
                if($Member->status_member == 0)
                {
                    return redirect('/member/lock');
                }
            }
        }
        else if (!Auth::guard('member')->check()) {
            
            return redirect('/member/login');
        }
        
        return $next($request);
    }
}
