<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
  protected $guarded = [];
  use HasFactory;

  public function vehicles(): BelongsToMany{
    return $this->belongsToMany(Vehicle::class);
  }
}
