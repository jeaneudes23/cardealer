<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Listing extends Model
{
  use HasFactory;

  protected $guarded = [];

  protected $casts = [
    'images' => 'array'
  ];

  public function car(): BelongsTo
  {
    return $this->belongsTo(Car::class);
  }

  public static function search(?string $q = null, string $brand = null, string $model = null, string $type = null, string $condition = null, string $min_year = null, string $max_year = null, string $min_mileage = null, string $max_mileage = null, string $min_price = null, string $max_price = null): Builder
  {
    $query = self::query();

    if (filled($brand)) {
      $query->whereHas('car', function ($car) use ($brand) {
        $car->whereHas('brand', function ($inner) use ($brand) {
          $inner->where('slug', 'like', '%' . $brand . '%');
        });
      });
    }

    if (filled($model)) {
      $query->whereHas('car', function ($car) use ($model) {
        $car->whereHas('model', function ($inner) use ($model) {
          $inner->where('slug', 'like', '%' . $model . '%');
        });
      });
    }


    if (filled($type)) {
      $query->whereHas('car', function ($car) use ($type) {
        $car->where('types', function ($inner) use ($type) {
          $inner->where('slug', 'like', '%' . $type . '%');
        });
      });
    }

    if (filled($min_year)) {
      $query->whereHas('car', function ($car) use ($min_year) {
        $car->where('year', '>=', $min_year);
      });
    }

    if (filled($max_year)) {
      $query->whereHas('car', function ($car) use ($max_year) {
        $car->where('year', '<=', $max_year);
      });
    }

    if (filled($condition)) {
      $query->where('condition', 'like', '%' . $condition . '%');
    }

    if (filled($min_mileage)) {
      $query->where('mileage', '>=', $min_mileage);
    }

    if (filled($max_mileage)) {
      $query->where('mileage', '<=', $max_mileage);
    }

    if (filled($min_price)) {
      $query->where('price', '>=', $min_price);
    }

    if (filled($max_price)) {
      $query->where('price', '<=', $max_price);
    }

    return $query;
  }
}
