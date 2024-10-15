<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory;

    protected $guarded = [];
    use HasFactory;
  
    protected static function booted()
    {
      static::creating(function(Brand $brand){
        $brand->slug = Str::slug($brand->name);
      });
  
      static::updating(function(Brand $brand){
        $brand->slug = Str::slug($brand->name);
      });
    }
  
    public function models(): HasMany{
      return $this->hasMany(CarModel::class);
    }
  
    public function cars(): HasMany{
      return $this->hasMany(Car::class);
    }
}
