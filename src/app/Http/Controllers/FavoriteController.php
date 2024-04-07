<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggleFavorite($id)
    {
        $user = Auth::user();
        $restaurant = Restaurant::findOrFail($id);

        if ($user->favorites->contains($restaurant)) {
            $user->favorites()->detach($restaurant);
        } else {
            $user->favorites()->attach($restaurant);
        }

        return back();
    }
}
