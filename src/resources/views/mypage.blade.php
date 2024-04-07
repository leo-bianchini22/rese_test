@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')

<div class="mypage_content">
    <div class="mypage_inner">
        <div class="user_name">
            <p>{{ Auth::user()->name }}さん</p>
        </div>
        <div class="mypage_item">
            <div class="reservation_info">
                <div class="reservation_ttl">
                    <p>予約状況</p>
                    <a href="/reservation/list">過去の予約一覧</a>
                </div>
                <div class="reservation_item">
                    @if($reservations->count() > 0)
                    @foreach($reservations as $key => $reservation)
                    <div class="reservation_card">
                        <div class="reservation_card_header">
                            <p>予約 {{ $key + 1 }}</p>
                            <div class="delete">
                                <form action="/reservation/delete" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $reservation->id }}">
                                    <button type="submit"></button>
                                </form>
                            </div>
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
                        <div class="reservation_card_bottom">
                            <form class="change_reservation" action="/reservation/edit">
                                @csrf
                                <input type="hidden" name="id" value="{{ $reservation->id }}">
                                <input type="hidden" name="restaurant_id" value="{{ $reservation->restaurant_id }}">
                                <button type="submit">予約を変更する</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p>予約がありません</p>
                    @endif
                </div>
            </div>
            <div class="favorite_info">
                <div class="favorite_ttl">
                    <p>お気に入り店舗</p>
                </div>
                <div class="favorite_item">
                    @if($favorites->count() > 0)
                    @foreach ($restaurants as $restaurant)
                    <div class="shop_card_group">
                        <div class="shop_card_inner">
                            <div class="shop_img"><img src="{{ $restaurant->image_url }}" alt="Restaurant Image"></div>
                            <div class="shop_item">
                                <div class="shop_name">
                                    <h2>{{ $restaurant->name }}</h2>
                                </div>
                                <div class="shop_category">
                                    <ul>
                                        <li>#{{ $restaurant->area->name }}</li>
                                        <li>#{{ $restaurant->genre->name }}</li>
                                    </ul>
                                </div>
                                <div class="shop_bottom">
                                    <div class="shop_detail">
                                        <a href="{{ route('shopId', ['id'=>$restaurant->id]) }}">詳しく見る</a>
                                    </div>
                                    @auth
                                    <div class="shop_favorite">
                                        <form action="{{ route('toggleFavorite', ['id' => $restaurant->id]) }}" method="post">
                                            @csrf
                                            <button type="submit" class="favorite_button @if(Auth::user()->favorites->contains($restaurant)) active @endif">
                                                @if(Auth::user()->favorites->contains($restaurant))
                                                <img src="{{ asset('img/red_heart.png') }}" alt="Red Heart">
                                                @else
                                                <img src="{{ asset('img/grey_heart.png') }}" alt="Grey Heart">
                                                @endif
                                            </button>
                                        </form>
                                    </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p>お気に入り店舗がありません</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection