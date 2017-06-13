<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use URL;
use App\Section;
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/');
        }

        $backURL = parse_url(URL::previous());
        if(isset($backURL['query'])) {
            parse_str($backURL['query'], $query);
            if(isset($query['album']) && isset($query['slide'])) 
                session(['backURL' => url('sections/'.Section::find($query["album"])->slug.'#lg=1&slide='.$query['slide'])]);            
        }
        elseif(strpos(URL::previous(), 'sections') || strpos(URL::previous(), 'photos'))
            session(['backURL' => URL::previous()]);

        return $next($request);
    }
}
