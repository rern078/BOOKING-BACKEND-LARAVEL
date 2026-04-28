<?php

namespace App\Http\Middleware;

use App\Models\ApiToken;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $header = (string) $request->header('Authorization', '');
        if (! str_starts_with($header, 'Bearer ')) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        $plain = trim(substr($header, strlen('Bearer ')));
        if ($plain === '') {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        $hash = hash('sha256', $plain);
        $token = ApiToken::query()->where('token_hash', $hash)->first();
        if (! $token) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        $user = User::query()->find($token->user_id);
        if (! $user) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        if (! (bool) ($user->is_active ?? true)) {
            return response()->json(['message' => 'Your account is disabled.'], 403);
        }

        $token->forceFill(['last_used_at' => now()])->save();

        $request->setUserResolver(fn () => $user);
        $request->attributes->set('api_token_plain', $plain);

        return $next($request);
    }
}

