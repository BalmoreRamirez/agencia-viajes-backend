<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelImage extends Model
{
    protected $guarded = [];

    public function travel()
    {
      return $this->belongsTo(Travel::class);
    }
}
