{{-- 共通レイアウトの表示 --}}
@extends('layouts.app')
@section('page_title', 'Confirm')
{{-- 専用cssの読み込み --}}
@section('css')
    <link rel="stylesheet" href={{ asset('css/confirm.css') }}>
@endsection

{{-- メインコンテンツ --}}
@section('content')

<div class="confirm-form__container">
    <div class="form__inner">
        <form action="{{route('store')}}" method="post">
            @csrf
            
            {{-- 個別のhiddenフィールドで必要なデータを送信 --}}
            <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
            <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
            <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
            <input type="hidden" name="email" value="{{ $contact['email'] }}">
            {{-- 電話番号を分割して送信（バリデーション用） --}}
            <input type="hidden" name="tel_1" value="{{ substr($contact['tel'], 0, 3) }}">
            <input type="hidden" name="tel_2" value="{{ substr($contact['tel'], 3, 4) }}">
            <input type="hidden" name="tel_3" value="{{ substr($contact['tel'], 7) }}">
            <input type="hidden" name="address" value="{{ $contact['address'] }}">
            <input type="hidden" name="building" value="{{ $contact['building'] ?? '' }}">
            <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
            <input type="hidden" name="detail" value="{{ $contact['detail'] }}">

            {{-- フォーム入力内容の表示 --}}
            <div class="confirm-item">
                <div class="confirm-label">お名前</div>
                <div class="confirm-data">{{ $contact['last_name'] }} {{ $contact['first_name'] }}</div>
            </div>

            <div class="confirm-item">
                <div class="confirm-label">性別</div>
                <div class="confirm-data">
                    @if($contact['gender'] == 1) 男性
                    @elseif($contact['gender'] == 2) 女性
                    @else その他
                    @endif
                </div>
            </div>

            <div class="confirm-item">
                <div class="confirm-label">メールアドレス</div>
                <div class="confirm-data">{{ $contact['email'] }}</div>
            </div>
            
            <div class="confirm-item">
                <div class="confirm-label">電話番号</div>
                <div class="confirm-data">{{ $contact['tel'] }}</div>
            </div>
            
            <div class="confirm-item">
                <div class="confirm-label">住所</div>
                <div class="confirm-data">{{ $contact['address'] }}</div>
            </div>
            
            <div class="confirm-item">
                <div class="confirm-label">建物名</div>
                <div class="confirm-data">{{ $contact['building'] ?? '' }}</div>
            </div>
            
            <div class="confirm-item">
                <div class="confirm-label">お問い合わせ項目</div>
                <div class="confirm-data">
                    @if(isset($category))
                        {{ $category->content }}
                    @else
                        お問い合わせ項目{{ $contact['category_id'] }}
                    @endif
                </div>
            </div>
            
            <div class="confirm-item">
                <div class="confirm-label">お問い合わせ内容</div>
                <div class="confirm-data">{{ $contact['detail'] }}</div>
            </div>

            <div class="confirm-buttons">
                <button type="submit" class="confirm-submit">送信</button>
                <button type="button" class="confirm-back" onclick="history.back()">修正</button>
            </div>
        </form>
    </div>
</div>

@endsection