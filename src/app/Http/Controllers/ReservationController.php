<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function detailById($id)
    {
        $restaurant = Restaurant::with('reviews')->find($id);

        // 時間の選択肢を作成
        $startTime = strtotime('17:00');
        $endTime = strtotime('23:00');
        $interval = 60 * 30;
        $times = array();
        $current = $startTime;
        while ($current <= $endTime) {
            $times[] = date('H:i', $current);
            $current += $interval;
        }

        // 予約人数の選択肢を作成
        $peoples = range(1, 10);

        return view('detail', compact('restaurant', 'times', 'peoples'));
    }

    public function storeReservation(Request $request)
    {
        $reservationData = $request->only([
            'restaurant_id',
            'reservation_date',
            'reservation_time',
            'number_of_people',
        ]);

        $reservationData['user_id'] = Auth::id();

        Reservation::create($reservationData);

        return view('done');
    }

    public function deleteReservation(Request $request)
    {
        Reservation::find($request->id)->delete();
        return redirect('/mypage');
    }

    public function editReservation(Request $request)
    {
        $restaurant = Restaurant::find($request->restaurant_id);

        // 時間の選択肢を作成
        $startTime = strtotime('17:00');
        $endTime = strtotime('23:00');
        $interval = 60 * 30;
        $times = array();
        $current = $startTime;
        while ($current <= $endTime) {
            $times[] = date('H:i', $current);
            $current += $interval;
        }

        // 予約人数の選択肢を作成
        $peoples = range(1, 10);

        $reservation = Reservation::find($request->id);

        return view('edit', compact('restaurant', 'times', 'peoples', 'reservation'));
    }

    public function updateReservation(Request $request)
    {
        $reservationData = $request->only([
            'restaurant_id',
            'reservation_date',
            'reservation_time',
            'number_of_people',
        ]);

        $reservationData['user_id'] = Auth::id();

        unset($reservationData['_token']);
        Reservation::find($request->id)->update($reservationData);
        return redirect('/mypage');
    }
}
