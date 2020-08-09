<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AgencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'name' => $this->name,
          'logo' => $this->logo,
          'address' => $this->address,
          'phone_number' => $this->phone_number,
          'mobile_number' => $this->mobile_number,
          'email' => $this->email,
          'description' => $this->description,
          'rating' => $this->ratings->avg('rating')
        ];
    }
}
