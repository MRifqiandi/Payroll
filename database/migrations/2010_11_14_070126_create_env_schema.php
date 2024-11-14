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
        ];

        foreach ($tables as $key => $value) {
            config(["database.tables.{$key}" => $value]);
            Utils::CREATE_ENV_VARIABLE($key, $value);
        }

        $permission = [
            'roles' => Str::uuid(),
            'permissions' => Str::uuid(),
            'model_has_permissions' => Str::uuid(),
            'model_has_roles' => Str::uuid(),
            'role_has_permissions' => Str::uuid(),
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
