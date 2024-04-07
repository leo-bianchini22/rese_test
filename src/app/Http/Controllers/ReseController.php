<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Favorite;
use App\Models\Genre;
use App\Models\Reservation;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReseController extends Controller
{
    public function home()
    {
        $areas = Area::all();
        $genres = Genre::all();
        $restaurants = Restaurant::all();

        return view('index', compact('areas', 'genres', 'restaurants'));
    }

    public function search(Request $request)
    {
        $areas = Area::all();
        $genres = Genre::all();
        $restaurants = Restaurant::areaSearch($request->area_id)
            ->genreSearch($request->genre_id)
            ->keywordSearch($request->keyword)
            ->get();

        return view('index', compact('areas', 'genres', 'restaurants'));
    }

    public function myPage()
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)
            ->where('reservation_date', '>=', now()->startOfDay())
            ->orderBy('reservation_date')
            ->get();

        $favorites = Favorite::where('user_id', $user->id)->get();
        $restaurants = [];
        foreach ($favorites as $favorite) {
            $restaurant = Restaurant::find($favorite->restaurant_id);
            if ($restaurant) {
                $restaurants[] = $restaurant;
            }
        }

        return view('mypage', compact('reservations', 'favorites', 'restaurants'));
    }

    public function listReservation()
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)
            ->orderBy('reservation_date')
            ->get();

        return view('reservation_list', compact('reservations'));
    }
}
