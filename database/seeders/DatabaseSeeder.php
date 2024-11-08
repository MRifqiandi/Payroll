<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Utils;
use Illuminate\Database\Seeder;
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

        foreach (range(1, 10) as $i) {
            (function () use ($i) {
                $key = Utils::GENERATE_RSA_KEY();
                $privateKey = Utils::ENCRYPT_ENV($key['private_key']);
                $publicKey = $key['public_key'];

                User::create([
                    'name' => 'User ' . $i,
                    'email' => 'kucing' . $i . '@gmail.com',
                    'password' => bcrypt('12345678'),
                    'number' => '123456',
                    'rank' => 'staff ' . $i,
                    'position' => 'staff ' . $i,
                    'public_key' => $publicKey,
                    'private_key' => $privateKey,
                ])->assignRole('staff');
            })();
        }
    }
}
