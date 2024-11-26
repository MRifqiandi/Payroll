<?php

use App\Utils;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tables = [
            'DB_USERS' => Str::uuid(),
            'DB_USER_UPLOADS' => Str::uuid(),
            'DB_USER_FILES' => Str::uuid(),
            'DB_API_KEYS' => Str::uuid(),
        ];

        foreach ($tables as $key => $value) {
            if (env($key)) {
                config(["database.tables.{$key}" => env($key)]);
            } else {
                config(["database.tables.{$key}" => $value]);
                Utils::CREATE_ENV_VARIABLE($key, $value);
            }
        }

        $permission = [
            'roles' => env('DB_ROLES') ?? Str::uuid(),
            'permissions' => env('DB_PERMISSIONS') ?? Str::uuid(),
            'model_has_permissions' => env('DB_MODEL_HAS_PERMISSIONS') ?? Str::uuid(),
            'model_has_roles' => env('DB_MODEL_HAS_ROLES') ?? Str::uuid(),
            'role_has_permissions' => env('DB_ROLE_HAS_PERMISSIONS') ?? Str::uuid(),
        ];

        config(["permission.table_names" => $permission]);
        Utils::CREATE_ENV_VARIABLE('DB_ROLES', $permission['roles']);
        Utils::CREATE_ENV_VARIABLE('DB_PERMISSIONS', $permission['permissions']);
        Utils::CREATE_ENV_VARIABLE('DB_MODEL_HAS_PERMISSIONS', $permission['model_has_permissions']);
        Utils::CREATE_ENV_VARIABLE('DB_MODEL_HAS_ROLES', $permission['model_has_roles']);
        Utils::CREATE_ENV_VARIABLE('DB_ROLE_HAS_PERMISSIONS', $permission['role_has_permissions']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
