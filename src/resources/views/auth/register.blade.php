{{-- 共通のレイアウト --}}
@extends('layouts.app')

{{-- ページタイトル --}}
@section('page_title', 'Register')

{{-- このページ専用のCSSを読み込む --}}
@section('css')
    <link rel="stylesheet" href={{ asset('css/register.css') }}>
@endsection

{{-- メインコンテンツ --}}
@section('content')
<div class="register-page__content">
    <form class="form" action="{{ route('register') }}" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
            </div>
            <div class="form__input--text">
                <input type="text" name="name" value="{{ old('name') }}" placeholder="例: 山田太郎" class="form__input">
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
            </div>
            <div class="form__input--text">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="例:test@example.com" class="form__input">
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">パスワード</span>
            </div>
            <div class="form__input--text">
                <input type="password" name="password" placeholder="coachtech1106" class="form__input">
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form__button">
            <button type="submit" class="form__submit-button">登録</button>
        </div>
    </form>
</div>
@endsection

