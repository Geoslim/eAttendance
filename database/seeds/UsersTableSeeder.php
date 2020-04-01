<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'george@kjk.africa')->first();

        if(!$user)
        {
            User::create([
                'fullname' => 'Admin Panel',
                'email' => 'george@kjk.africa',
                'role' => '1',
                'mobile' => '07030102959',
                'status' => 'Signed Out',
                'profile_image' => 'uploads/profile.png',
                'designation_id' => '0',
                'password' => Hash::make('password'),
                ]);
        }

    }
}
