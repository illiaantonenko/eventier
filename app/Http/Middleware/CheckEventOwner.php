<?php

namespace App\Http\Middleware;

use App\Models\EventRegistration;
use Closure;

class CheckEventOwner
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
        $referer = url()->current();
        $hash = substr(strrchr($referer,'/'),1);
        if (auth()->user()->id == EventRegistration::where('hash','=',$hash)->first()->event->user->id){
            return $next($request);
        }else{
            abort('404');
        }
    }
}
