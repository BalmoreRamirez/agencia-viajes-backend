<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    protected $guarded = [];

    public function agency()
    {
      return $this->belongsTo(Agency::class);
    }

    public function images()
    {
      return $this->hasMany(TravelImage::class);
    }
    public function travelDates()
    {
      return $this->hasMany(TravelDate::class);
    }
}
