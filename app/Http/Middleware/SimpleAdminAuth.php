<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SimpleAdminAuth
{
    /**
     * Autentikasi basic sederhana berbasis kredensial di .env.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = env('ADMIN_USER', 'admin');
        $pass = env('ADMIN_PASSWORD', 'secret');

        if ($request->getUser() !== $user || $request->getPassword() !== $pass) {
            return response('Unauthorized', 401, [
                'WWW-Authenticate' => 'Basic realm="Pengaduan Admin"',
            ]);
        }

        return $next($request);
    }
}

