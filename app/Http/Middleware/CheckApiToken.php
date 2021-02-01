<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckApiToken
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
      // genero il token
      $auth_token = $request->header('authorization');
      // se il token manca restituisco un errore
      if (empty($auth_token)) {
        return response()->json([
          'success' => false,
          'error' => 'API token mancante'
        ]);
      }
      // con substr recupero il token senza il bearer
      $api_token = substr($auth_token, 7);
      // verifico se l'api token è corretto con una query
      User::where('api_token', $api_token)->first()
      if (!$user) {
        return response()->json([
          'success' => false,
          'error' => 'API token errato'
        ])
      }
      return $next($request);
    }
}
