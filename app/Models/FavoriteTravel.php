<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteTravel extends Model
{
    protected $guarded = [];

    public function user()
    {
      return $this->belongsTo(User::class);
    }


  public function travel()
  {
    return $this->belongsTo(Travel::class);
  }

    public function scopeIsNewRecord($query, $travel)
    {
      return ! $query->where('travel_id', $travel->id)->exists();
    }
    public function scopeRemoveRecord($query, $travel)
    {
      return $query->where('travel_id', $travel->id)->delete();
    }
}
