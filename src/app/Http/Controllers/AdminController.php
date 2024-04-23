<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepresentativeRequest;
use App\Http\Requests\RestaurantRequest;
use App\Models\Representative;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

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

    public function storeRepresentative(RepresentativeRequest $request)
    {
        $representative = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'representative_id' => $request->representative_id,
        ]);

        // 代表者のロールを割り当てる
        $representative->assignRole('representative');

        Representative::create([
            'restaurant_id' => $request->restaurant_id,
        ]);

        return redirect('/');
    }

    public function admin()
    {
        $representatives = User::whereNotNull('representative_id')->paginate(10);

        return view('admin', compact('representatives'));
    }

    public function deleteRepresentative(Request $request)
    {
        User::find($request->id)->delete();
        return redirect('/admin');
    }

    public function representative()
    {
        $user = Auth::user();
        $reservations = Reservation::where('restaurant_id', $user->representative->restaurant_id)->paginate(5);

        return view('admin-representative', compact('reservations'));
    }
}
