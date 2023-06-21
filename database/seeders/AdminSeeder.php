<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
           'username'=>'admin', 
           'email'=>'admin@gmail.com',
           'password'=>Hash::make('admin123456'),
           'role_id'=>1, 
        ]);
    }
}