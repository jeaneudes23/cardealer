<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Type extends Model
{
  use HasFactory;
  protected $guarded = [];

  protected static function booted()
  {
    static::creating(function (Type $type) {
      $type->slug = Str::slug($type->name);
    });

    static::updating(function (Type $type) {
      $type->slug = Str::slug($type->name);
    });
  }

  public function cars(): BelongsToMany
  {
    return $this->belongsToMany(Car::class);
  }
}
