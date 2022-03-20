<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Customer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            "name"=> $this->name,
            "last_name"=> $this->last_name,
            "address"=> $this->address,
            "descRegion"=> $this->descRegion,
            "descCommune"=> $this->descCommune
        ];
    }
}
