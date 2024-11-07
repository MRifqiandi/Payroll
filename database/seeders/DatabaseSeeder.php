<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
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

        User::create([
            'name' => 'Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('12345678'),
            'number' => '123456',
            'rank' => 'Admin',
            'position' => 'Admin',
        ])->assignRole('admin');

        User::create([
            'name' => 'finance',
            'email' => 'finance@gmail.com',
            'password' => bcrypt('12345678'),
            'number' => '123456',
            'rank' => 'Admin',
            'position' => 'Admin',
        ])->assignRole('finance');

        User::create([
            'name' => 'staff',
            'email' => 'staff@gmail.com',
            'password' => bcrypt('12345678'),
            'number' => '123456',
            'rank' => 'Admin',
            'position' => 'Admin',
        ])->assignRole('staff');
    }
}
