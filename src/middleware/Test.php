<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Customer;
use App\User;
use App\Admin;
use Lcobucci\JWT\Parser;
use Laravel\Passport\TokenRepository;

class Test
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard)
    {
        $headers = apache_request_headers();
        $bearer = $headers['Authorization'];

        $bearerT = substr($bearer, 7);
        
        $jwt = (new Parser())->parse($bearerT);
        $tokenRepository = new TokenRepository();
        $token= $tokenRepository->find($jwt->getClaim('jti'));

        //dd($token->client_id);

        switch ($guard) {
            case 'admin':
                $client_id = ADMIN::PASSPORT;
                break;
            case 'customer':
                $client_id = CUSTOMER::PASSPORT;
                break;
            default:
                $client_id = USER::PASSPORT;
                break;
        }

        if ($token->client_id == $client_id) {
            return $next($request);
        } else {
            dd("no entras");
        }

    }
}
