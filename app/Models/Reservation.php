<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $guarded = [];

    public function travelDates()
    {
      return $this->belongsTo(TravelDate::class, 'travel_date_id', 'id');
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function scopeFindReservations($query, $travel)
    {
      return $query->whereHas('travelDates', function ($query) use ($travel) {
        $query->where('travel_id', $travel->id);
      });
    }
}
