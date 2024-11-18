<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SalesPerson extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $guarded = [];
    protected $hidden = ['password','remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted()
    {
      static::creating(function (SalesPerson $salesPerson){
        $salesPerson->role = 'sales_person';
      });

      static::addGlobalScope('salesPerson', function(Builder $query){
        $query->where('role','sales_person');
      });
    }

    public function appointments(): HasMany{
      return $this->hasMany(Appointment::class);
    }
}
