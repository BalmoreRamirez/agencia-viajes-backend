<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
  protected $guarded = [];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function networks()
  {
    return $this->hasMany(Network::class);
  }

  public function comments()
  {
    return $this->hasMany(Comment::class);
  }

  public function ratings()
  {
    return $this->hasMany(Rating::class);
  }

  public function travels()
  {
    return $this->hasMany(Travel::class);
  }
}
