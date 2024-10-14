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
class VehicleModel extends Model
{
    use HasFactory;
    protected $table = 'models';

    protected $guarded = [];

    protected static function booted()
  {
    static::creating(function(Model $model){
      $model->slug = Str::slug($model->name);
    });
    static::updating(function(Model $model){
      $model->slug = Str::slug($model->name);
    });
  }

  public function make(): BelongsTo{
    return $this->belongsTo(Make::class);
  }

  public function vehicles(): HasMany{
    return $this->hasMany(Vehicle::class);
  }
}
