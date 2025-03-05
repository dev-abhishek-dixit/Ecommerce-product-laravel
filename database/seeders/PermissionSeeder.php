<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('permissions')->insert([
            [
                'slug' => '/profile',
                'role_id'=>1,
        ],
        [
            'slug' => '/profile',
            'role_id'=>2,
    ],
    [
        'slug' => '/profile',
        'role_id'=>3,
],
[
    'slug' => '/profile',
    'role_id'=>4,
],
[
    'slug' => '/cart/add/',
    'role_id'=>1,
],
[
    'slug' => '/dashboard',
    'role_id'=>1,
],
[
    'slug' => '/dashboard',
    'role_id'=>2,
],
[
    'slug' => '/dashboard',
    'role_id'=>3,
],
[
    'slug' => '/dashboard',
    'role_id'=>4,
],
[
    'slug' => '/product/store',
    'role_id'=>1,
],
[
    'slug' => '/product/store',
    'role_id'=>2,
],
[
    'slug' => '/user-list',
    'role_id'=>1,
],
[
    'slug' => '/user-list',
    'role_id'=>2,
],
[
    'slug' => '/user-list',
    'role_id'=>3,
],


           
        ]);
    }
}
