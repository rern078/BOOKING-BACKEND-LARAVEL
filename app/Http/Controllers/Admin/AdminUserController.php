<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $users = User::query()
            ->with('roles')
            ->withMax('apiTokens', 'last_used_at')
            ->when($q !== '', function ($query) use ($q) {
                $query->where('name', 'ilike', "%{$q}%")
                    ->orWhere('email', 'ilike', "%{$q}%");
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users', 'q'));
    }

    public function show(User $user)
    {
        $user->load(['roles', 'customer'])->loadMax('apiTokens', 'last_used_at');

        return view('admin.users.show', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'role' => ['required', 'string', 'in:admin,user'],
        ]);

        $role = Role::firstOrCreate(
            ['name' => $data['role']],
            ['display_name' => ucfirst($data['role'])]
        );

        // Single role for simplicity: sync replaces existing roles
        $user->roles()->sync([$role->id]);

        return back()->with('status', 'User role updated.');
    }

    public function updateStatus(Request $request, User $user)
    {
        $data = $request->validate([
            'is_active' => ['required', 'boolean'],
        ]);

        if (Auth::id() === $user->id && ! (bool) $data['is_active']) {
            return back()->withErrors(['is_active' => 'You cannot disable your own account.']);
        }

        $user->update(['is_active' => (bool) $data['is_active']]);

        return back()->with('status', $user->is_active ? 'User enabled.' : 'User disabled.');
    }
}

