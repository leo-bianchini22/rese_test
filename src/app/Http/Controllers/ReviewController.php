<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\Review;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function review(Request $request)
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)->get();
        $restaurant = Restaurant::find($request->restaurant_id);

        return view('review', compact('restaurant', 'reservations'));
    }

    public function store(ReviewRequest $request)
    {
        $reviewData = $request->only([
            'restaurant_id',
            'rating',
            'comment',
        ]);

        $reviewData['user_id'] = Auth::id();

        Review::create($reviewData);

        return redirect()->back();
    }

    public function reviewDetail(Request $request)
    {
        // 最初のリクエストで $restaurant の ID をセッションに保存
        if ($request->has('id')) {
            $request->session()->put('restaurant_id', $request->id);
        }

        $user = Auth::user();
        $restaurantId = $request->session()->get('restaurant_id');
        $restaurant = Restaurant::find($restaurantId);
        $reviews = Review::where('restaurant_id', $restaurantId)->paginate(4);

        return view('review-detail', compact('restaurant', 'reviews'));
    }
}
