@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')

<div class="detail_content">
    <div class="detail_inner">
        <div class="shop_info">
            <div class="shop_form">
                <form class="back_form" action="/back" method="post">
                    @csrf
                    <button type="submit">&lt;</button>
                    <h2 class="shop_name">{{ $restaurant->name }}</h2>
                </form>
            </div>
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
                        @csrf
                        <input type="hidden" name="id" value="{{ $restaurant->id }}">
                        <button type="submit">詳しいレビューを見る</button>
                    </form>
                    @else
                    <p>まだレビューはありません。</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="shop_edit">
            <p class="edit_text">店舗データ編集</p>
            <form class="shop_form" action="/restaurant/update" method="post">
                @csrf
                <div class="shop_form_inner">
                    <div class="form_group">
                        <p>店舗画像</p>
                        <input class="edit_img" type="file" name="image_url" id="image_url">
                        @error('image_url')
                        <div class="error">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form_group">
                        <p>店舗詳細</p>
                        <textarea class="edit_textarea" name="detail" id="detail">{{ $restaurant->detail }}</textarea>
                        @error('detail')
                        <div class="error">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <!-- 店舗データ変更ボタン -->
                <div class="restaurant_submit">
                    <input type="hidden" name="id" value="{{ $restaurant->id }}">
                    <button type="submit">店舗データを変更する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection