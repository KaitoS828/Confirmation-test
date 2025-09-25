{{-- 共通レイアウトなし --}}

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thanks</title>
    {{-- フォント読み込み --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&family=Noto+Serif+JP:wght@200..900&display=swap" rel="stylesheet">
    {{-- CSS読み込み --}}
    <link rel="stylesheet" href={{ asset('css/sanitize.css') }}>
    <link rel="stylesheet" href={{ asset('css/common.css') }}>
    <link rel="stylesheet" href={{ asset('css/thanks.css') }}>
</head>

<body>
<div class="thanks-page">
    <div class="thanks-page__content">
        <h1>お問い合わせありがとうございました</h1>
        <a href="/" class="thanks-page__button">HOME</a>
    </div>
</div>

</body>
</html>