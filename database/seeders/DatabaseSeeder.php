<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        //\App\Models\User::factory(10)->create();

        $user = new User();
        $user->name = "Prueba customer";
        $user->email = "prueba@gmail.com";
        $user->password = Hash::make('321123');
        $user->save();

    }
}
