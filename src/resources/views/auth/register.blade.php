@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth_content">
    <form class="form" action="/register" method="post">
        @csrf
        <div class="form_ttl">
            <p>Registration</p>
        </div>
        <div class="form_inner">
            <div class="form_group_content">
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
</div>
@endsection