@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('search')
<div class="header_inner_right">
    <form class="search_form" action="/search" method="get">
        <select class="search_select" name="area_id">
            <option value="" selected>All area</option>
            @foreach ($areas as $area)
            <option id="area_id" value="{{ $area->id }}">{{ $area->name }}</option>
            @endforeach
        </select>
        <select class="search_select" name="genre_id">
            <option value="" selected>All genre</option>
            @foreach ($genres as $genre)
            <option id="genre_id" value="{{ $genre->id }}">{{ $genre->name }}</option>
            @endforeach
        </select>
        <div class="search_item">
            <button class="search_submit" type="submit"><img src="{{ asset('img/search.png') }}" alt="search_icon"></button>
            <input class="search_input" type="text" name="keyword" value="" placeholder="Search...">
        </div>
    </form>
</div>
@endsection

@section('content')
<div class="home_content">
    <div class="home_inner">
        @foreach ($restaurants as $restaurant)
        <div class="shop_card_group">
            <div class="shop_card_inner">
                <div class="shop_img"><img src="{{ $restaurant->image_url }}" alt="Restaurant Image">
                </div>
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
                    <div class="shop_review">
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
                        @else
                        <p>レビューがありません。</p>
                        @endif
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
    </div>
</div>
@endsection