<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Region;
use App\Models\Commune;
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



        $region = new Region();
        $region->insert([
            "id_reg" => 1,
            "description" => "Norte",
            "status" => "A"
        ]);

        $region->insert([
            "id_reg" => 2,
            "description" => "Norte-occidente",
            "status" => "A"
        ]);

        $region->insert([
            "id_reg" => 3,
            "description" => "Centro-norte",
            "status" => "A"
        ]);

        $region->insert([
            "id_reg" => 4,
            "description" => "Centro",
            "status" => "A"
        ]);

        $region->insert([
            "id_reg" => 5,
            "description" => "Sur",
            "status" => "A"
        ]);



        $commune = new Commune();
        $commune->insert([
            "id_com" => 1,
            "id_reg" => 1,
            "description" => "Baja california",
            "status" => "A"
        ]);

        
        $commune->insert([
            "id_com" => 2,
            "id_reg" => 1,
            "description" => "Sonora",
            "status" => "A"
        ]);

        $commune->insert([
            "id_com" => 3,
            "id_reg" => 1,
            "description" => "Tamaulipas",
            "status" => "I"
        ]);
      
        $commune->insert([
            "id_com" => 4,
            "id_reg" => 2,
            "description" => "Baja california sur",
            "status" => "I"
        ]);
        

        $commune->insert([
            "id_com" => 5,
            "id_reg" => 2,
            "description" => "Sinaloa",
            "status" => "I"
        ]);

        $commune->insert([
            "id_com" => 6,
            "id_reg" => 4,
            "description" => "Puebla",
            "status" => "trash"
        ]);

        $commune->insert([
            "id_com" => 7,
            "id_reg" => 4,
            "description" => "Ciudad de Mexico",
            "status" => "trash"
        ]);
        

    }
}
