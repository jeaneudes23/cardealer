<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

  protected $casts = [
    'features' => 'array'
  ];

  protected static function booted()
  {
    static::creating(function (Car $car) {
      $car->slug = Str::slug($car->name);
    });
    static::updating(function (Car $car) {
      $car->slug = Str::slug($car->name);
    });
  }

  public function brand(): BelongsTo
  {
    return $this->belongsTo(Brand::class);
  }
  public function model(): BelongsTo
  {
    return $this->belongsTo(CarModel::class, 'car_model_id');
  }
  public function types(): BelongsToMany
  {
    return $this->belongsToMany(Type::class);
  }

  public function listings(): HasMany
  {
    return $this->hasMany(Listing::class);
  }

  public function reviews(): HasMany
  {
    return $this->hasMany(Review::class);
  }

  public static function search(?string $q = null, string $brand = null, string $model = null, string $type = null, string $min_year = null, string $max_year = null): Builder
  {
    $query = self::query();

    if (filled($q)) {
      $query->where(function ($car) use ($q) {
        $car->where('slug', 'like', '%' . $q . '%')->OrWhere('name', 'like', '%' . $q . '%');
      });
    }
    if (filled($brand)) {
      $query->whereHas('brand', function ($inner) use ($brand) {
        $inner->where('slug', 'like', '%' . $brand . '%');
      });
    }

    if (filled($model)) {
      $query->whereHas('model', function ($inner) use ($model) {
        $inner->where('slug', 'like', '%' . $model . '%');
      });
    }

    if (filled($type)) {
      $query->whereHas('types', function ($inner) use ($type) {
        $inner->where('slug', 'like', '%' . $type . '%');
      });
    }

    if (filled($min_year)) {
      $query->where('year', '>=', $min_year);
    }

    if (filled($max_year)) {
      $query->where('year', '<=', $max_year);
    }

    return $query;
  }

  public function related() {
    return $this->brand->cars()->take(4)->get();
  }


}
