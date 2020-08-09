<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TravelResource extends JsonResource
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
          'title' => $this->title,
          'start_place' => $this->start_place,
          'available' => $this->available,
          'price' => $this->price,
          'start_date' => $this->start_date,
          'end_date' => $this->end_date,
          'limit_date' => $this->limit_date,
          'images' => $this->images,
          'agency' => $this->agency,
          'description' => $this->description,
          'dates' => $this->travelDates,
        ];
    }
}
