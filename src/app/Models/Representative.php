<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
