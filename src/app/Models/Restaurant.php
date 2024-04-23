<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'area_id',
        'genre_id',
        'image_url',
        'detail',
    ];

    // Area モデルとのリレーション
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    // Genre モデルとのリレーション
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    // Reservation モデルとのリレーション
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Review モデルとのリレーション
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Representative モデルとのリレーション
    public function representative()
    {
        return $this->hasOne(Representative::class);
    }

    // 検索
    public function scopeAreaSearch($query, $area_id)
    {
        if (!empty($area_id)) {
            $query->where('area_id', $area_id);
        }
    }
    public function scopeGenreSearch($query, $genre_id)
    {
        if (!empty($genre_id)) {
            $query->where('genre_id', $genre_id);
        }
    }
    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }
    }
}
