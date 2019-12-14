<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CekSession
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
        if ( (!$request->session()->exists('token')) || (!$request->session()->exists('profile')) ) {
            return redirect('admin/login');
        } else {
            $dataRegister['token'] = Session::get('token');
            $url = config('app.api')."/test";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataRegister);        
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);        
            $server_output = curl_exec($ch);        
            curl_close ($ch);                     
            
            if ( $server_output == "Unauthorized.") 
            {
             return redirect('admin/logout');   
            }
                
        }
        return $next($request);
    }
}
