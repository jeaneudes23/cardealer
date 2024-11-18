<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
  protected $guarded = [];
  use HasFactory;

  public function customer(): BelongsTo{
    return $this->belongsTo(Customer::class);
  }

  public function listing(): BelongsTo{
    return $this->belongsTo(Listing::class);
  }

  public function salesPerson(): BelongsTo{
    return $this->belongsTo(SalesPerson::class);
  }
}
