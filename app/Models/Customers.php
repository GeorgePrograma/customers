<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customers extends Model
{
    use HasFactory;

    //protected $guarded = [];
    protected $fillable = [
        "dni",
        "id_reg",
        "id_com",
        "email",
        "name",
        "last_name",
        "address",
        "date_reg"
    ];
    
    
    public function Communes(){
        return $this->belongsTo("App\Models\Commune");
    }


    public function getAllInfoCustomer($id){
        return Customers::
        join("communes", "communes.id_com", "=", "customers.id_com" )
        ->join("regions", "regions.id_reg", "=", "customers.id_reg" )
        ->select(
            "customers.dni",
            "customers.id_reg",
            "customers.id_com",
            "customers.email",
            "customers.name",
            "customers.last_name",
            "customers.address",
            "customers.date_reg",
            "customers.status",
            "regions.description as descRegion",
            "communes.description as descCommune"  
        )
        ->where("customers.status", "=", "A")
        ->get();
    }


    public function getCustomersActives(){
        return Customers::
        join("communes", "communes.id_com", "=", "customers.id_com" )
        ->join("regions", "regions.id_reg", "=", "customers.id_reg" )
        ->select(
            "customers.name",
            "customers.last_name",
            "customers.address",
            "regions.description as descRegion",
            "communes.description as descCommune"  
        )
        ->where("customers.status", "=", "A")
        ->get();
    }


    public function getCustomerActive($id){
        return Customers::
        join("communes", "communes.id_com", "=", "customers.id_com" )
        ->join("regions", "regions.id_reg", "=", "customers.id_reg" )
        ->select(
            "customers.name",
            "customers.last_name",
            "customers.address",
            "regions.description as descRegion",
            "communes.description as descCommune"  
        )
        ->where("customers.dni", "=","$id")
        ->where("customers.status", "=", "A")
        ->get();
    }


    public function deleteCostumer($id){
        return DB::table("customers")
        ->where("dni", "=", $id)->delete();
        
    }




}
