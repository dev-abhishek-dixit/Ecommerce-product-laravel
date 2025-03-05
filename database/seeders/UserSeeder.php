<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
       $user=   User::create(
            [
                "name" => "Rahul Nain",
                "email" => "18182112indian@gmail.com",
                "password" => Hash::make('18182112@ASra')
                ]);
       $user->roles()->attach(1);
    }
}
