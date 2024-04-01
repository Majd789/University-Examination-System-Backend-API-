<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=> 'admin' ,
            'permission'=>'admin',
            'academic_rank'=>'teacher',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('admin')
        ]);
        //php artisan db:seed --class=UsersTableSeeder
    }
}
