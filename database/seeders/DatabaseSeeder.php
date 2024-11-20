<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Utils;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'finance']);
        Role::create(['name' => 'staff']);

        collect([])->map(function ($permission) {
            Permission::create(['name' => $permission]);
        });

        $key = Utils::GENERATE_RSA_KEY();
        $privateKey = Utils::ENCRYPT_ENV($key['private_key']);
        $publicKey = $key['public_key'];

        User::create([
            'name' => 'Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('12345678'),
            'number' => '123456',
            'rank' => 'Admin',
            'position' => 'Admin',
            'public_key' => $publicKey,
            'private_key' => $privateKey,
        ])->assignRole('admin');

        User::create([
            'name' => 'finance',
            'email' => 'finance@gmail.com',
            'password' => bcrypt('12345678'),
            'number' => '123456',
            'rank' => 'Admin',
            'position' => 'Admin',
            'public_key' => $publicKey,
            'private_key' => $privateKey,
        ])->assignRole('finance');

        User::create([
            'name' => 'staff',
            'email' => 'staff@gmail.com',
            'password' => bcrypt('12345678'),
            'number' => '123456',
            'rank' => 'Admin',
            'position' => 'Admin',
            'public_key' => $publicKey,
            'private_key' => $privateKey,
        ])->assignRole('staff');

        collect([
            199210102019032033,
            199008112019032016,
            197004211998021001,
            198909012019031008,
            199112212019032018,
            198909212019031006,
            199609112022032020,
            199808222022032011,
            198705212010122005,
            198908192019031010,
            198910082015042002,
            198512182019031011,
            199111292019032017,
            199804032022031008
        ])->map(function ($num) {
            $key = Utils::GENERATE_RSA_KEY();
            $privateKey = Utils::ENCRYPT_ENV($key['private_key']);
            $publicKey = $key['public_key'];

            User::create([
                'name' => 'Staff',
                'email' => $num . '@gmail.com',
                'password' => bcrypt('12345678'),
                'number' => $num,
                'rank' => 'Staff',
                'position' => 'Staff',
                'public_key' => $publicKey,
                'private_key' => $privateKey,
            ])->assignRole('staff');
        });
    }
}
