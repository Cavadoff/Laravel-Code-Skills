<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;




class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Unkown author',
                'email' => 'author_unkown@g.g',
                'password' =>Hash::make(Str::random(16)),

            ],
            [
                'name' => 'Author',
                'email' => 'authorl@g.g',
                'password' =>Hash::make(value:123456),
   
             
            ],
        ];
        \DB::table('users')->insert($data);
    }
}
