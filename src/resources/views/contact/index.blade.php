{{-- app.blade.phpの共通レイアウトを継承 --}}
@extends('layouts.app')

{{-- ページタイトルを設定 --}}
@section('page_title', 'Contact')

{{-- このページ専用のCSSを読み込む --}}
@section('css')
    <link rel="stylesheet" href={{ asset('css/index.css') }}>
@endsection

{{-- メインコンテンツ --}}
@section('content')

<div class="contact-form__content">
    <form action="{{route('confirm')}}" class="form" method="post">
        @csrf
        <div class="form__inner">
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__input--text">
                <div class="form__input-row">
                    <input type="text" name="last_name" placeholder="例: 山田">
                    <input type="text" name="first_name" placeholder="例: 太郎">
                </div>
                @error('last_name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
                @error('first_name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__input--radio">
                <div class="form__input-row">
                    <input type="radio" name="gender" value="1">
                    <span class="form__label--radio">男性</span>
                    <input type="radio" name="gender" value="2">
                    <span class="form__label--radio">女性</span>
                    <input type="radio" name="gender" value="3">
                    <span class="form__label--radio">その他</span>
                </div>
                @error('gender')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__input--text">
                <div class="form__input-row">
                    <input type="text" name="email" placeholder="例:test@example.com">
                </div>
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__input--text">
                <div class="form__input-row">
                    <div class="form__input--text__tel">
                        <input type="text" name="tel_1" placeholder="080">
                        <span class="form__label--hyphen">-</span>
                        <input type="text" name="tel_2" placeholder="1234">
                        <span class="form__label--hyphen">-</span>
                        <input type="text" name="tel_3" placeholder="5678">
                    </div>
                </div>
                @error('tel')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__input--text">
                <div class="form__input-row">
                    <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
                </div>
                @error('address')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__input--text">
                <div class="form__input-row">
                    <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101">
                </div>
                @error('building')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ項目</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__input--select">
                <div class="form__input-row">
                    <select name="category_id">
                        <option value="" hidden>選択してください</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->content }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="form__group">
            <div class="form__group-title">
                <pspan class="form__label--item">お問い合わせ内容<span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__input--textarea">
                <div class="form__input-row">
                    <textarea name="detail" cols="30" rows="10" placeholder="例: お問い合わせ内容をこちらにご記載ください。"></textarea>
                </div>
                @error('detail')
                    <div class="form-error">{{ $message }}</div>
                @enderror
                @error('detail.max')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
        </div>
    </form>
</div>
@endsection