<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Renis',
            'email' => 'admin@admin.com',
            'phone_number' => '0684615633',
            'birthday' => '2000-09-05',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->assignRole('admin');

        User::create([
            'name' => 'Thanas',
            'email' => 'user@user.com',
            'phone_number' => '0686868688',
            'birthday' => '2002-09-05',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->assignRole('user');

        User::create([
            'name' => 'Ortenc',
            'email' => 'user@userrr.com',
            'phone_number' => '0696969699',
            'birthday' => '1998-09-05',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->assignRole('user');
    }
}
