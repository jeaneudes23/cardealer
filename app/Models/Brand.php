<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
  protected $guarded = [];
  use HasFactory;

  public function model(): HasMany{
    return $this->hasMany(Model::class);
  }

  public function vehicles(): HasMany{
    return $this->hasMany(Vehicle::class);
  }
}
