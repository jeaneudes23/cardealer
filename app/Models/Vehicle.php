<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vehicle extends Model
{
  protected $guarded = [];
  use HasFactory;

  public function brand(): BelongsTo{
    return $this->belongsTo(Brand::class);
  }
  public function model(): BelongsTo{
    return $this->belongsTo(Model::class);
  }
  public function categories(): BelongsToMany{
    return $this->belongsToMany(Category::class);
  }
}
