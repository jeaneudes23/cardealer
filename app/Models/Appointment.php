<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
  protected $guarded = [];
  use HasFactory;

  public function car(): BelongsTo{
    return $this->belongsTo(Car::class);
  }

  public function customer(): BelongsTo {
    return $this->belongsTo(Customer::class);
  }

  public function salesPerson(): BelongsTo {
    return $this->belongsTo(SalesPerson::class);
  }
}
