<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;


/**
 * Class Vehicle
 * @property string $title
 * @property string $slug
 */

class Vehicle extends Model
{
  protected $guarded = [];
  use HasFactory;

  protected static function booted()
  {
    static::creating(function(Vehicle $vehicle){
      $make = Make::find($vehicle->make_id)->name;
      $model = Make::find($vehicle->model_id)->name;
      $vehicle->slug = Str::slug($make.' '.$model.' '.$vehicle->year);
    });

    static::updating(function(Category $vehicle){
      $make = Make::find($vehicle->make_id)->name;
      $model = Make::find($vehicle->model_id)->name;
      $vehicle->slug = Str::slug($make.' '.$model.' '.$vehicle->year);
    });
  }

  public function make(): BelongsTo{
    return $this->belongsTo(Make::class);
  }
  public function model(): BelongsTo{
    return $this->belongsTo(VehicleModel::class);
  }
  public function categories(): BelongsToMany{
    return $this->belongsToMany(Category::class);
  }
}
