@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')

<div class="detail_content">
    <div class="detail_inner">
        <div class="shop_info">
            <form class="back_form" action="/back" method="post">
                @csrf
                <button type="submit">&lt;</button>
                <h2 class="shop_name">{{ $restaurant->name }}</h2>
            </form>
            <div class="shop_img">
                <img src="{{ $restaurant->image_url }}" alt="Restaurant Image">
            </div>
            <div class="shop_item">
                <div class="shop_category">
                    <ul>
                        <li>#{{ $restaurant->area->name }}</li>
                        <li>#{{ $restaurant->genre->name }}</li>
                    </ul>
                </div>
                <div class="shop_detail">
                    <p>{{ $restaurant->detail }}</p>
                </div>
                <div class="review_info">
                    <h3>レビュー情報</h3>
                    @if($restaurant->reviews->count() > 0)
                    <p>評価:
                        @php
                        $avgRating = $restaurant->reviews->avg('rating');
                        $roundedRating = round($avgRating);
                        @endphp
                        @for ($i = 1; $i <= 5; $i++) @if ($i <=$roundedRating) <span class="star">&#9733;</span>
                            @else
                            <span class="star">&#9734;</span>
                            @endif
                            @endfor
                            ({{ number_format($avgRating, 1) }})
                    </p>
                    <p>レビュー数: {{ $restaurant->reviews->count() }}</p>
                    <form action="/review/detail">
                        <input type="hidden" name="id" value="{{ $restaurant->id }}">
                        <button type="submit">詳しいレビューを見る</button>
                    </form>
                    @else
                    <p>まだレビューはありません。</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="shop_reservation">
            <p class="edit_text">予約編集</p>
            @livewire('reservation-edit', ['restaurant' => $restaurant, 'reservation' => $reservation, 'times' => $times, 'peoples' => $peoples])
        </div>
    </div>
</div>
@endsection

@section('js')
@livewireScripts
@endsection