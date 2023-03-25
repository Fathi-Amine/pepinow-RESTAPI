<?php

namespace Database\Seeders;

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
        User::factory()->count(1)->create()->each(function($user){
            $user->assignRole('Admin');
        });
        User::factory()->count(1)->create()->each(function($user){
            $user->assignRole('vendor');
        });
        User::factory()->count(8)->create()->each(function($user){
            $user->assignRole('customer');
        });
    }
}
