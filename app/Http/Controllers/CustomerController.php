<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\Region;
use App\Models\Commune;
use App\Models\Log;

use App\Http\Resources\Customer as CustomerResource;

class CustomerController extends Controller
{
    private $debug;

    public function __construct(){
        $this->debug = env("APP_DEBUG", false);
    }
    

    public function index(){

        $customers = new Customers;

        $this->checkDebug("out", "get");
        return response()->json([
            "success"=>true,
            "data"=>CustomerResource::collection($customers->getCustomersActives())
        ]);
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

            $this->checkDebug("entry", "post");
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

        $this->checkDebug("out", "get");
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
                $this->checkDebug("destroy", "delete");
                return response()->json(["success"=>true], 204);
            }
    }




    private function checkDebug($typeRequest, $method){

        if($this->debug == false && $typeRequest == "entry" ){
            Log::create([
                "type_request"=>$typeRequest,
                "method"=>$method,
                "ip"=>$_SERVER["REMOTE_ADDR"]
            ]);
        }else if($this->debug == true ){
            Log::create([
                "type_request"=>$typeRequest,
                "method"=>$method,
                "ip"=>$_SERVER["REMOTE_ADDR"]
            ]);
        }
    } 

}
