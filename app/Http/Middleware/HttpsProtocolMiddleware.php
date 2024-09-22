<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DB;

class HttpsProtocolMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // $mysql_link = @mysqli_connect(env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE'), env('DB_PORT'));
        $mysql_link = @mysqli_connect('127.0.0.1', 'sa', '!QAZ2wsx@F0X', 'helpdesk', 3306);
        if (mysqli_connect_errno() || !DB::getSchemaBuilder()->hasTable('settings') ) {
            return $next($request);

        }else{
            if(setting('FORCE_SSL') == 'on'){
                if (!$request->secure()) {
                    return redirect()->secure($request->getPathInfo());
                }
                return $next($request);
            }else{
                return $next($request);
            }
        }


    }
}
