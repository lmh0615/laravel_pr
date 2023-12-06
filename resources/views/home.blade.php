<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css2?family=Cute+Font&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Cute Font', cursive;
        }
    </style>
</head>
<body class="antialiased" style="background-image: url('storage/images/배경.png'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    @if (Route::has('login'))
        <div class="fixed top-0 right-0 p-6 text-right z-10">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn btn-light btn-lg border-dark"><strong>나의 글</strong></a></a>
            @else
                <a href="{{ route('login') }}" class="btn btn-light btn-lg border-dark"><strong>로그인</strong></a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg border-dark"><strong>회원가입</strong></a>
                @endif
            @endauth
        </div>
    @endif

    <div class="d-flex flex-column align-items-center justify-content-start" style="height: 100vh; padding-top: 5vh;">
        <h1 class="font-bold text-4xl mb-4">유기동물 게시판</h1>
        <div>
            <a href="{{ route('input') }}" class="mx-4 btn btn-light btn-lg border-dark">
                <img src="storage/images/글쓰기.png" alt="Icon" style="height: 20px;">
                <strong>글쓰기</strong>
            </a>
            <a href="{{ route('list') }}" class="mx-4 btn btn-light btn-lg border-dark">
                <img src="storage/images/리스트.png" alt="Icon" style="height: 20px;">
                <strong>리스트</strong>
            </a>
        </div>
    </div>
</body>
</html>