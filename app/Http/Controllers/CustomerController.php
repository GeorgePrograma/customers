<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\Region;
use App\Models\Commune;
use App\Http\Resources\Customer as CustomerResource;

class CustomerController extends Controller
{
    private $debug = false;

    public function __construct(){
        $debug = env("APP_DEBUG", true);
    }
    

    public function index(){

        return $this->debug;

        $customers = new Customers;
        return response()->json([
            "success"=>true,
            "data"=>CustomerResource::collection($customers->getCustomersActives())
        ]);

       /*  ?dni=dexb1&id_reg=5&id_com=23&email=jorge.beristain@gmail.com&name=jorge&last_name=beristain&address=av mariano&date_reg=2022-03-10 18:44:14&status=I */
    }


    public function store(Request $request)
    {
        $region = new Region;
        $commune = new Commune;

        $region = $region->searchRegion($request->id_reg);
        $commune = $commune->searchCommune($request->id_com);

        if($region && $commune)
        {
            $request->validate([
                "dni" => "required",
                "id_reg" => "required",
                "id_com" => "required",
                "email" => "required|email|max:120",
                "name" => "required|max:45",
                "last_name" => "required|max:45",
                "address" => "required|max:255"
            ]);
            
            $customer = Customers::insert([
                "dni" => $request->dni,
                "id_reg" => $request->id_reg,
                "id_com" => $request->id_com,
                "email" => $request->email,
                "name" => $request->name,
                "last_name" => $request->last_name,
                "address" => $request->address,
                "date_reg" => date('Y-m-d H:i:s')
            ]);
            return response()->json(["success"=>$customer], 201 );
        }
        else{
            return response()->json([
                "success"=>false,
                "error"=>"Check commune ID or Region ID"
            ]);
        }

    }

    
    public function show(Customers $customer, $id){
        if( preg_match('/[a-z0-9._-]+\@[a-z0-9._-]+\.[a-z._-]/i', $id) ){
            $data = $customer->getCustomerActiveByEmail($id)->first() ;
        }
        else{  
            $data = $customer->getCustomerActiveByDNI($id)->first() ;
        }

        return $data = response()->json(["success"=>true, "data"=>$data], 200);
    }


    public function destroy($id){
        $success= false;
        $customer = new Customers();
        $existCustomer = $customer->getAllInfoCustomer($id)->first();
    
        if(!$existCustomer){
            return response()->json(["success"=>false, "error"=>"Row doesn`t exist"]);
        }else
            if($existCustomer->status == "A" || $existCustomer->status == "I")
            {
                $success = $existCustomer->deleteCostumer($existCustomer->dni);
                return response()->json(["success"=>true], 204);
            }


    }

}
