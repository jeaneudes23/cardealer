<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;


/**
 * Class Model
 * @property string $name
 * @property string $slug
 * @property string $brand_id
 */

class CarModel extends Model
{
  use HasFactory;

  protected $guarded = [];

  protected static function booted()
  {
    static::creating(function (Model $model) {
      $model->slug = Str::slug($model->name);
    });
    static::updating(function (Model $model) {
      $model->slug = Str::slug($model->name);
    });
  }

  public function brand(): BelongsTo
  {
    return $this->belongsTo(Brand::class);
  }

  public function cars(): HasMany
  {
    return $this->hasMany(Car::class);
  }

  public static function whereBrandSlug(string $slug) {
    return CarModel::whereHas('brand', function ($query) use($slug){$query->where('slug',$slug);});
  }
}
