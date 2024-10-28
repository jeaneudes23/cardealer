<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static function booted(){

      static::created(function(Review $review){
        $car = $review->car;

        $count = $car->reviews_count;
        $average = $car->average_rating;

        $car->update([
          'average_rating' => (($average * $count)+$review->rating)/($count+1),
          'reviews_count' => $count + 1
        ]);

      });

    }

    public function customer(){
      return $this->belongsTo(Customer::class);
    }

    public function car(){
      return $this->belongsTo(Car::class);
    }
}
