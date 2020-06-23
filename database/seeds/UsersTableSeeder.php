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
        $user = User::where('email', 'admmin@admin.com')->first();

        if(!$user)
        {
            User::create([
                'fullname' => 'Admin Panel',
                'email' => 'admin@admin.com',
                'role' => '1',
                'mobile' => '07030102959',
                'status' => 'Signed Out',
                'profile_image' => 'profile.png',
                'designation_id' => '0',
                'password' => Hash::make('password'),
               
                ]);
        }

    }
}
