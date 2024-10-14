<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Admin
 * @property string $name
 * @property string $email
 * @property string $role
 */
class Admin extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'users';
    
    protected $hidden = [
      'password',
      'remember_token',
  ];

    protected static function booted()
    {
      static::addGlobalScope('admin', function(Builder $query){
        $query->where('role','admin');
      });

      static::creating(function($admin){
        $admin->role = 'admin';
      });
    }
}
