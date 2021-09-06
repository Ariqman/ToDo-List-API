<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "superadmin",
            'email' => 'superadmin00@admin.com',
            'password'=>bcrypt(12345),
            'role' =>'superadmin'
        ]);

        User::create([
            'name' => "admin",
            'email' => 'admin00@admin.com',
            'password'=>bcrypt(12345),
            'role' =>'admin'
        ]);
        User::create([
            'name' => "akuntest1",
            'email' => 'akuntest1@gmail.com',
            'password'=>bcrypt(12345),
            'role' =>'user'
        ]);
    }
}
