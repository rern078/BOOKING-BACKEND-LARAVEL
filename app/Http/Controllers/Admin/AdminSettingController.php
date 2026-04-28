<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $settings = Setting::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where('key', 'like', "%{$q}%")
                    ->orWhere('group', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            })
            ->orderBy('group')
            ->orderBy('key')
            ->paginate(20)
            ->withQueryString();

        return view('admin.settings.index', compact('settings', 'q'));
    }

    public function create()
    {
        return view('admin.settings.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'key' => ['required', 'string', 'max:255', 'unique:settings,key'],
            'group' => ['nullable', 'string', 'max:255'],
            'type' => ['nullable', 'string', 'max:30'],
            'description' => ['nullable', 'string'],
            'value_raw' => ['nullable', 'string'],
        ]);

        $value = $this->parseValue($data['value_raw'] ?? null);

        Setting::create([
            'key' => $data['key'],
            'group' => $data['group'] ?? null,
            'type' => $data['type'] ?? null,
            'description' => $data['description'] ?? null,
            'value' => $value,
        ]);

        return redirect()->route('admin.settings.index')->with('status', 'Setting created.');
    }

    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $data = $request->validate([
            'key' => ['required', 'string', 'max:255', 'unique:settings,key,'.$setting->id],
            'group' => ['nullable', 'string', 'max:255'],
            'type' => ['nullable', 'string', 'max:30'],
            'description' => ['nullable', 'string'],
            'value_raw' => ['nullable', 'string'],
        ]);

        $value = $this->parseValue($data['value_raw'] ?? null);

        $setting->update([
            'key' => $data['key'],
            'group' => $data['group'] ?? null,
            'type' => $data['type'] ?? null,
            'description' => $data['description'] ?? null,
            'value' => $value,
        ]);

        return back()->with('status', 'Setting updated.');
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();

        return redirect()->route('admin.settings.index')->with('status', 'Setting deleted.');
    }

    private function parseValue(?string $raw): array|null
    {
        $raw = is_string($raw) ? trim($raw) : '';
        if ($raw === '') {
            return null;
        }

        $decoded = json_decode($raw, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $decoded;
        }

        return ['value' => $raw];
    }
}
