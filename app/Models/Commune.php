<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;

    //Relacion de Muchos a Uno
    public function Regions(){
        return $this->belongsTo("App\Models\Region");
    }

    //Relacion de Uno a Muchos
    public function Customers(){
        return $this->hasMany("App\Models\Customers");
    }

    public function searchCommune($id){
        $commune = new Commune;
        return $commune->where("id_com", "=", $id)->first();
    }


}
