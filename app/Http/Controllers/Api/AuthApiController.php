<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ApiToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::query()->where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials.'], 422);
        }

        if (! (bool) ($user->is_active ?? true)) {
            return response()->json(['message' => 'Your account is disabled.'], 403);
        }

        $plain = Str::random(40);
        $hash = hash('sha256', $plain);

        ApiToken::query()->create([
            'user_id' => $user->id,
            'token_hash' => $hash,
            'last_used_at' => now(),
        ]);

        $user->load('roles');

        return response()->json([
            'token' => $plain,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'is_active' => (bool) ($user->is_active ?? true),
                'roles' => $user->roles->pluck('name')->values(),
            ],
        ]);
    }

    public function me(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        $user->load('roles');

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'is_active' => (bool) ($user->is_active ?? true),
                'roles' => $user->roles->pluck('name')->values(),
            ],
        ]);
    }

    public function logout(Request $request)
    {
        $token = (string) $request->attributes->get('api_token_plain', '');
        if ($token !== '') {
            $hash = hash('sha256', $token);
            $row = ApiToken::query()->where('token_hash', $hash)->first();
            if ($row) {
                // Log out completely: remove all tokens for this user
                ApiToken::query()->where('user_id', $row->user_id)->delete();
            } else {
                ApiToken::query()->where('token_hash', $hash)->delete();
            }
        }

        return response()->json(['ok' => true]);
    }
}

