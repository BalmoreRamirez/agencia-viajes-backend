<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
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
          'id' => $this->id,
          'quantity' => $this->quantity,
          'user' => $this->user->select('name', 'last_name', 'email', 'phone')->first(),
          'travel_date' => $this->travelDates->with('travel')->first(),
        ];
    }
}
