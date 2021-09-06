<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderBean extends Model
{
    use HasFactory;

    public function beans()
    {
        return $this->hasMany(OrderBean::class);
    }
}
