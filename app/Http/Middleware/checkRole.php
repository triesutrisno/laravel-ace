<?php

namespace App\Http\Middleware;

use Closure;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $link)
    {
        $hakAkses = session('hakAkses');
        foreach ($hakAkses as $key => $val){
            //dd($hakAkses);            
            foreach ($val['data1'] as $key2 => $dtLink){
                //dd($dtLink['menu_link']);
                //dd($link);
                if($dtLink['menu_link']==$link){
                    return $next($request);
                }
            }
        }
        return abort(401);
    }
}
