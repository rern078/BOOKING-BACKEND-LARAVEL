<?php

return [
    /*
     * Cache TTL for settings lookups (in seconds).
     */
    'cache_ttl_seconds' => env('SETTINGS_CACHE_TTL', 300),

    /*
     * Default/fallback values when a key does not exist in DB.
     * Use full keys (e.g. "site.name").
     */
    'defaults' => [
        'site.name' => 'Chamrern Booking',
        'site.support_email' => 'support@example.com',
        'booking.default_currency' => 'USD',
        'booking.tax_rate' => 0,
        'features.reviews_enabled' => true,
    ],
];

