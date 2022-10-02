<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'name'=>'Administrator',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('123'),
            'phone_number'=>'02156515645',
            'type'=>'admin',
        ]);

        User::create([
            'name'=>'Hany Mohamed',
            'email'=>'m@m.com',
            'password'=>Hash::make('123456'),
            'phone_number'=>'02156515615',
            'type'=>'super-admin',
        ]);

        DB::table('users')->insert([
            'name'=>'ahmed khaled',
            'email'=>'a@a.com',
            'password'=>Hash::make('123456'),
            'phone_number'=>'01465214578',
            'type'=>'user',
        ]);
    }
}
