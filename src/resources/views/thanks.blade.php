@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')

<div class="thanks_content">
    <div class="thanks_inner">
        <div class="thanks_text">
            <p>会員登録ありがとうございます</p>
        </div>
        <div class="back_button">
            <a href="/login">ログインする</a>
        </div>
    </div>
</div>
@endsection