@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/list.css') }}">
@endsection

@section('content')
<div class="list_content">
    <div class="list_inner">
        <div class="user_name">
            <p>{{ Auth::user()->name }}さん</p>
        </div>
        <div class="list_item">
            <div class="reservation_info">
                <div class="reservation_ttl">
                    <p>過去の予約一覧</p>
                </div>
                <div class="reservation_item">
                    @if($reservations->count() > 0)
                    @foreach($reservations as $key => $reservation)
                    <div class="reservation_card">
                        <div class="reservation_card_header">
                            <p>予約 {{ $key + 1 }}</p>
                            <form action="/review">
                                <input type="hidden" name="restaurant_id" value="{{ $reservation->restaurant_id }}">
                                <button type="submit">レビューする</button>
                            </form>
                        </div>
                        <div class="reservation_table">
                            <table>
                                <tr class="reservation_table_row">
                                    <td>Shop</td>
                                    <td>{{ $reservation->restaurant->name }}</td>
                                </tr>
                                <tr class="reservation_table_row">
                                    <td>Date</td>
                                    <td>{{ $reservation->reservation_date }}</td>
                                </tr>
                                <tr class="reservation_table_row">
                                    <td>Time</td>
                                    <td>{{ date('H:i', strtotime($reservation->reservation_time)) }}</td>
                                </tr>
                                <tr class="reservation_table_row">
                                    <td>Number</td>
                                    <td>{{ $reservation->number_of_people }}人</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    @endforeach
                    <div class="paginate">
                        {{ $reservations->render('pagination::bootstrap-4') }}
                    </div>
                    @else
                    <p>予約がありません</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection