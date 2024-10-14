<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

/**
 * Class Category
 * @property string $name
 * @property string $slug
 */

class Category extends Model
{
  protected $guarded = [];
  use HasFactory;

  protected static function booted()
  {
    static::creating(function(Category $category){
      $category->slug = Str::slug($category->name);
    });

    static::updating(function(Category $category){
      $category->slug = Str::slug($category->name);
    });
  }

  public function vehicles(): BelongsToMany{
    return $this->belongsToMany(Vehicle::class);
  }
}
