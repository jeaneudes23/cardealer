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


class Car extends Model
{
  protected $guarded = [];
  use HasFactory;

  protected static function booted()
  {
    static::creating(function(Car $car){
      $car->slug = Str::slug($car->name);
    });
    static::updating(function(Car $car){
      $car->slug = Str::slug($car->name);
    });

  }

  public function make(): BelongsTo{
    return $this->belongsTo(Make::class);
  }
  public function model(): BelongsTo{
    return $this->belongsTo(CarModel::class,'car_model_id');
  }
  public function categories(): BelongsToMany{
    return $this->belongsToMany(Category::class);
  }
}
