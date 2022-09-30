<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
            'level' => 'admin',
        ]);

        User::create([
            'name' => 'User 1',
            'username' => 'user1',
            'email' => 'user1@example.com',
            'password' => Hash::make('123456'),
            'level' => 'user',
        ]);

        User::create([
            'name' => 'User 2',
            'username' => 'user2',
            'email' => 'user2@example.com',
            'password' => Hash::make('123456'),
            'level' => 'user',
        ]);

        User::create([
            'name' => 'Teknisi 1',
            'username' => 'teknisi1',
            'email' => 'teknisi1@example.com',
            'password' => Hash::make('123456'),
            'level' => 'teknisi',
        ]);

        User::create([
            'name' => 'Teknisi 2',
            'username' => 'teknisi2',
            'email' => 'teknisi2@example.com',
            'password' => Hash::make('123456'),
            'level' => 'teknisi',
        ]);

        User::create([
            'name' => 'Aset 1',
            'username' => 'aset1',
            'email' => 'aset1@example.com',
            'password' => Hash::make('123456'),
            'level' => 'aset',
        ]);

        User::create([
            'name' => 'Aset 2',
            'username' => 'aset2',
            'email' => 'aset2@example.com',
            'password' => Hash::make('123456'),
            'level' => 'aset',
        ]);
    }
}
