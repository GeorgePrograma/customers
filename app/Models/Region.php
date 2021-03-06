<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        "description",
        "status"
    ];

    //Relacion de Uno a Muchos
    public function communes(){
        return $this->hasMany("App\Models\Commune");
    }


    public function searchRegion($id){
        $region = new Region;
        return $region->where("id_reg", "=", $id)->first();
    }


}
