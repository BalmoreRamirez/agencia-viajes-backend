<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    protected $guarded = [];

    public function agency()
    {
      return $this->belongsTo(Agency::class);
    }
}
