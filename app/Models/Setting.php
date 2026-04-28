<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
        'description',
    ];

    protected $casts = [
        'value' => 'array',
    ];

    protected static function booted(): void
    {
        static::saved(function (self $setting) {
            Cache::forget(self::cacheKey($setting->key));
        });

        static::deleted(function (self $setting) {
            Cache::forget(self::cacheKey($setting->key));
        });
    }

    public static function getValue(string $key, mixed $default = null): mixed
    {
        $ttlSeconds = (int) (config('settings.cache_ttl_seconds', 300));

        return Cache::remember(self::cacheKey($key), $ttlSeconds, function () use ($key, $default) {
            $row = self::query()->where('key', $key)->first();
            if (! $row) {
                return config('settings.defaults.'.$key, $default);
            }

            return self::unwrap($row->value, $default);
        });
    }

    public static function putValue(string $key, mixed $value, array $meta = []): self
    {
        $wrapped = is_array($value) ? $value : ['value' => $value];

        /** @var self $setting */
        $setting = self::query()->updateOrCreate(
            ['key' => $key],
            [
                'value' => $wrapped,
                'group' => $meta['group'] ?? null,
                'type' => $meta['type'] ?? null,
                'description' => $meta['description'] ?? null,
            ]
        );

        Cache::forget(self::cacheKey($key));

        return $setting;
    }

    private static function unwrap(mixed $value, mixed $default): mixed
    {
        if ($value === null) {
            return $default;
        }

        if (is_array($value) && array_key_exists('value', $value) && count($value) === 1) {
            return $value['value'];
        }

        return $value;
    }

    private static function cacheKey(string $key): string
    {
        return 'settings.'.$key;
    }
}
