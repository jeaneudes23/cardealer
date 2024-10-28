<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
  use HasFactory;
  protected $guarded = [];
  protected $table = 'users';

  protected $hidden = [
    'password',
    'remember_token'
  ];

  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  protected static function booted()
  {
    static::addGlobalScope('customer', function (Builder $builder) {
      $builder->where('role', 'customer');
    });

    static::creating(function ($customer) {
      $customer->role = 'customer';
    });
  }

  public function appointments(): HasMany{
    return $this->hasMany(Appointment::class);
  }

  public function reviews(): HasMany{
    return $this->hasMany(Review::class);
  }
}
