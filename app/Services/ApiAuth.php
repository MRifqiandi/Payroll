<?php

namespace App\Services;

use App\Models\ApiKey;

class ApiAuth
{
    protected static ?ApiKey $key = null;

    /**
     * Set the API key for the current request.
     *
     * @param ApiKey $key
     * @return void
     */
    public static function setKey(ApiKey $key): void
    {
        self::$key = $key;
    }

    /**
     * Get the current API key.
     *
     * @return ApiKey|null
     */
    public static function key(): ?ApiKey
    {
        return self::$key;
    }

    /**
     * Check if the API key has a specific permission.
     *
     * @param string $permission
     * @return bool
     */
    public static function hasPermission(string $permission): bool
    {
        return self::$key?->hasPermissionTo($permission) ?? false;
    }
}
