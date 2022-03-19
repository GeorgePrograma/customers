<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use App\Http\Resources\Customers as CustomerResource;

class CustomerController extends Controller
{

    public function index(){
        $customers = new Customers;
        return $customers->getCustomersActives();

       /*  ?dni=dexb&id_reg=4&id_com=23&email=jorge.beristain.hernandez@gmail.com&name=jorge&last_name=beristain&address=mariano matamoros&date_reg=2022-03-10 18:44:14&status=A */
    }


    public function store(Request $request){

       $valid = $request->validate([
            "dni" => "required",
            "id_reg" => "required",
            "id_com" => "required",
            "email" => "required|email|max:120",
            "name" => "required|max:45",
            "last_name" => "required|max:45",
            "address" => "required|max:255",
            "date_reg" => "required"
       ]);

        $customer = Customers::insert( $valid );
        return response()->json($customer, 201 );
    }

    
    public function show(Customers $customer, $id){
        return $customer->getCustomerActive($id)->first();
    }


    public function destroy($id){
        $customer = new Customers();
        $existCustomer = $customer->getAllInfoCustomer($id)->first();
        
        if($existCustomer->status == "A" || $existCustomer->status == "I"){
            $sucess = $existCustomer->deleteCostumer($existCustomer->dni);
        }

        return response()->json(null, 204);
    }

}
