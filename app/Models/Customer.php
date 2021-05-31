<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Customer extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('token', function(Builder $builder){
            $builder->whereNotNull('token');
        });
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
