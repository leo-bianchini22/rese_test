<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurantRequest;
use App\Models\Reservation;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function editRestaurant(Request $request)
    {
        $restaurant = Restaurant::find($request->restaurant_id);

        return view('edit-shop', compact('restaurant',));
    }

    public function updateRestaurant(RestaurantRequest $request)
    {
        $restaurantData = $request->only([
            'detail',
        ]);

        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $path = $image->store('public');
            $restaurantData['image_url'] = $path;
        }

        unset($restaurantData['_token']);
        Restaurant::find($request->id)->update($restaurantData);
        return redirect('/');
    }
}
