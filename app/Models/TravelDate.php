<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelDate extends Model
{
    protected $guarded = [];

    public function travel()
    {
      return $this->belongsTo(Travel::class);
    }
    public function reservations()
    {
      return $this->hasMany(Reservation::class, 'id', 'travel_date_id');
    }
}
