@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
<div class="review_content">
    <div class="review_inner">
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
        <div class="shop_review">
            <p class="review_text">レビュー</p>
            <form class="review_form" action="/review/store" method="post">
                @csrf
                <div class="review_form_inner">
                    <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                    <div class="form_group">
                        <label for="rating">評価</label>
                        <select name="rating" id="rating">
                            <option value="">評価を選択してください</option>
                            <option value="1">1 ☆</option>
                            <option value="2">2 ☆☆</option>
                            <option value="3">3 ☆☆☆</option>
                            <option value="4">4 ☆☆☆☆</option>
                            <option value="5">5 ☆☆☆☆☆</option>
                        </select>
                        @error('rating')
                        <div class="error">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form_group">
                        <label for="comment">コメント</label>
                        <textarea name="comment" id="comment" cols="30" rows="5" placeholder="コメントを入力してください"></textarea>
                        @error('comment')
                        <div class="error">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="review_submit">
                    <button type="submit">レビューを追加する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection