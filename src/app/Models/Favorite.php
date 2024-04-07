<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'restaurant_id',
    ];

    // User モデルとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Restaurant モデルとのリレーション
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
