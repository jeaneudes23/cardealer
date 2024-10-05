<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Model extends EloquentModel
{
  protected $guarded = [];
  use HasFactory;

  public function brand(): BelongsTo{
    return $this->belongsTo(Brand::class);
  }

  public function vehicles(): HasMany{
    return $this->hasMany(Vehicle::class);
  }
}
