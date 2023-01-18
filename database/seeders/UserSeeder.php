<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        $user = User::create([
            'name'=>'Abubakr',
            'email'=>'abubakr@gmail.com',
            'password'=>Hash::make('secret'),
        ]);
        $user->roles()->attach([1,3]);

        $user3 = User::create([
            'name'=>'Abdulloh',
            'email'=>'abdulloh@gmail.com',
            'password'=>Hash::make('secret'),
        ]);
        $user3->roles()->attach([2]);

//         \App\Models\User::factory(10)->create();

    }
}
