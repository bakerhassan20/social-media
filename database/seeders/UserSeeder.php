<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'name' => 'baker',
            'email' => 'baker@gmail.com',
            'password' => bcrypt('123456'),
            'gender' =>1,
            'img' => 'default_img.png',
            'cover_img'=>'defulat_cover_img.jpg',
        ]);
    }
}
