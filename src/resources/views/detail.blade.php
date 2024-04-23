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
                @hasanyrole('admin')
                <form class="edit_form" action="/restaurant/edit" method="get">
                    @csrf
                    <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                    <button type="submit">編集する</button>
                </form>
                @else
                @hasrole('representative')
                @if($restaurant->id == $user->representative_id)
                <form class="edit_form" action="/restaurant/edit" method="get">
                    @csrf
                    <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                    <button type="submit">編集する</button>
                </form>
                @endif
                @endhasrole
                @endhasanyrole
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
        <div class="shop_reservation">
            @hasanyrole('admin')
            <form class="representative_form" action="/register/representative" method="post">
                @csrf
                <div class="form_ttl">
                    <p>{{ $restaurant->name }}の店舗代表者を作成する</p>
                </div>
                <div class="form_inner">
                    <div class="form_group_content">
                        <input type="hidden" name="representative_id" value="{{ $restaurant->id }}">
                        <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                        <div class="form_group">
                            <div class="form_input">
                                <label for="img_user"><img src="{{ asset('img/user.png') }}" alt="loading"></label>
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="Username" />
                            </div>
                            <div class="form_error">
                                @error('name')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form_group">
                            <div class="form_input">
                                <label for="img_email"><img src="{{ asset('img/email.png') }}" alt="loading"></label>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" />
                            </div>
                            <div class="form_error">
                                @error('email')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form_group">
                            <div class="form_input">
                                <label for="img_password"><img src="{{ asset('img/key.png') }}" alt="loading"></label>
                                <input type="password" name="password" placeholder="Password" />
                            </div>
                            <div class="form_error">
                                @error('password')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form_button">
                        <button class="form_button_submit" type="submit">登録</button>
                    </div>
                </div>
            </form>
            @else
            <p class="reservation_text">予約</p>
            @livewire('reservation', ['restaurant' => $restaurant, 'times' => $times, 'peoples' => $peoples])
            @endhasanyrole
        </div>
    </div>
</div>
@endsection

@section('js')
@livewireScripts
@endsection