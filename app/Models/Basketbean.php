<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basketbean extends Model
{
    use HasFactory;
    public function bean()
    {
        return $this->belongsTo(Bean::class);
    }
}
