<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // $admin = User::create([
        //     'username' => 'adminkopinetgtlo',
        //     'password' => bcrypt('12345678'),
        // ]);

        // $admin->assignRole('admin');

        // $user = User::create([
        //     'username' => 'johndoe',
        //     'password' => bcrypt('12345678'),
        // ]);

        // $user->assignRole('user');

        $admin = Employee::create([
            'id_employee' => '122',
            'username' => 'admin',
            'fullname' => 'Administrator',
            'password' => bcrypt('12345678'),
            'role' => 'admin'
        ]);

        $user = Employee::create([
            'id_employee' => '123',
            'username' => 'user',
            'fullname' => 'mas lorem ipsum',
            'position' => 'Software Engineering',
            'gender' => 'l',
            'password' => bcrypt('12345678'),
            'role' => 'user'
        ]);
    }
}
