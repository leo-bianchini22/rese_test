@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin_content">
    <div class="admin_inner">
        <div class="user_name">
            <p>{{ Auth::user()->name }}</p>
        </div>
        <div class="admin_item">
            <div class="date-form">
                <form class="form" action="/representative/date" method="post">
                    @csrf
                    <button type="submit" name="changeDate" value="return">&lt;</button>
                    <input type="date" name="form__input-date" value="{{ $date }}" readonly></input>
                    <button type="submit" name="changeDate" value="next">&gt;</button>
                </form>
            </div>
            <div class="reservation_info">
                <div class="reservation_ttl">
                    <p>予約一覧</p>
                </div>
                <div class="reservation_item">
                    @if($reservations->count() > 0)
                    @foreach($reservations as $key => $reservation)
                    <div class="reservation_card">
                        <div class="reservation_table">
                            <table>
                                <tr class="reservation_table_row">
                                    <td>予約 {{ $key + 1 }}</td>
                                    <td></td>
                                </tr>
                                <tr class="reservation_table_row">
                                    <td>Name</td>
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
                    @else
                    <p>予約がありません</p>
                    @endif
                </div>
                <div class="paginate">
                    {{ $reservations->render('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection