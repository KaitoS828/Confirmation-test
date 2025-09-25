{{-- 共通のレイアウト --}}
@extends('layouts.app')

{{-- ページごとのコンテンツ --}}
@section('page_title', 'Admin')
@section('css')
    <link rel="stylesheet" href={{ asset('css/admin.css') }}>
@endsection

@section('content')
    {{-- 検索フォーム全体。GETメソッドで検索条件をURLに含めて送信する --}}
    <form action="{{ route('admin.index') }}" method="GET" class="search">
        {{-- 検索フォームエレメント --}}
        <div class="search__group">
            {{-- 名前またはメールアドレスの検索用入力欄（部分一致検索）--}}
            <input type="text" name="name_email" placeholder="名前またはメールアドレス" class="search__input">
        </div>

        <div class="search__group">
            {{-- 性別での絞り込み検索用ドロップダウン --}}
            <select name="gender" class="search__select">
                <option value="">性別</option>
                <option value="1">男性</option>
                <option value="2">女性</option>
                <option value="3">その他</option>
            </select>
        </div>
        
        <div class="search__group">
            {{-- お問い合わせの種類での絞り込み検索用ドロップダウン --}}
            <select name="category_id" class="search__select">
                <option value="">お問い合わせの種類</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->content }}</option>
                @endforeach
            </select>
        </div>

        <div class="search__group">
            {{-- 日付での絞り込み検索用入力欄 --}}
            <input type="date" name="date" class="search__input search__input--date">
        </div>

        <div class="search__actions">
            {{-- 検索実行ボタン --}}
            <button type="submit" class="search__button search__button--submit">検索</button>
            {{-- 検索条件をクリアして元のページに戻るリンク --}}
            <a href="{{ route('admin.index') }}" class="search__button search__button--reset">リセット</a>
        </div>
    </form>


    {{-- ページネーション --}}
    <div class="pagination">
        {{ $contacts->links('vendor.pagination.tailwind') }}
    </div>

    

    {{-- データ一覧テーブルブロック --}}
    <div class="contacts-table">
        <table class="contacts-table__list">
            <thead class="contacts-table__header">
                <tr class="contacts-table__row">
                    <th class="contacts-table__heading">お名前</th>
                    <th class="contacts-table__heading">性別</th>
                    <th class="contacts-table__heading">メールアドレス</th>
                    <th class="contacts-table__heading">お問い合わせの種類</th>
                    <th class="contacts-table__heading">操作</th>
                </tr>
            </thead>
<tbody>
    @foreach($contacts as $contact)
    <tr class="contacts-table__row">
        <td class="contacts-table__data">{{ $contact->last_name }} {{ $contact->first_name }}</td>
        <td class="contacts-table__data">{{ $contact->gender_text }}</td>
        <td class="contacts-table__data">{{ $contact->email }}</td>
        <td class="contacts-table__data">{{ $contact->category?->content }}</td>
        <td class="contacts-table__data">
            <button class="contacts-table__button"
                data-id="{{ $contact->id }}"
                data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
                data-gender="{{ $contact->gender_text }}"
                data-email="{{ $contact->email }}"
                data-tel="{{ $contact->tel }}"
                data-address="{{ $contact->address }}"
                data-building="{{ $contact->building }}"
                data-category="{{ $contact->category?->content }}"
                data-detail="{{ $contact->detail }}">
                詳細
            </button>
        </td>
    </tr>
    @endforeach
</tbody>
        </table>
    </div>

    {{-- モーダル機能 --}}
    <div id="modal-detail" class="modal-wrapper">
        <div class="modal">
            <div class="modal__content">
                <button class="modal__close-button">×</button>
                <div class="modal__details-container">
                    <table class="modal__detail-table">
                        <tr>
                            <th>お名前</th>
                            <td id="modal-name"></td>
                        </tr>
                        <tr>
                            <th>性別</th>
                            <td id="modal-gender"></td>
                        </tr>
                        <tr>
                            <th>メールアドレス</th>
                            <td id="modal-email"></td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                            <td id="modal-tel"></td>
                        </tr>
                        <tr>
                            <th>住所</th>
                            <td id="modal-address"></td>
                        </tr>
                        <tr>
                            <th>建物名</th>
                            <td id="modal-building"></td>
                        </tr>
                        <tr>
                            <th>お問い合わせの種類</th>
                            <td id="modal-category"></td>
                        </tr>
                        <tr>
                            <th>お問い合わせ内容</th>
                            <td id="modal-detail-text"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal__actions">
                    <form id="delete-form" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="modal__delete-button">削除</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection