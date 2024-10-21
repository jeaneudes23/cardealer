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

    public function car(): BelongsTo{
      return $this->belongsTo(Car::class);
    }

    public static function search(): Builder{
      $query = self::query();

      return $query;
    }
}
