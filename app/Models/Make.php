<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Make extends Model
{
    use HasFactory;

    protected $guarded = [];
    use HasFactory;
  
    protected static function booted()
    {
      static::creating(function(Make $make){
        $make->slug = Str::slug($make->name);
      });
  
      static::updating(function(Make $make){
        $make->slug = Str::slug($make->name);
      });
    }
  
    public function models(): HasMany{
      return $this->hasMany(VehicleModel::class);
    }
  
    public function vehicles(): HasMany{
      return $this->hasMany(VehicleModel::class);
    }
}
