<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Cute+Font&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Cute Font', cursive;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.2);
        }
        .logout-button {
            position: absolute;
            top: 15px;
            right: 20px;
        }
    </style>
</head>
<body>
    <div class="fixed top-0 left-2/4 p-6 text-center z-10">
        <a href="{{ url('/') }}" class="btn btn-light btn-lg border-dark">
            <img src="storage/images/홈.png" alt="home" style="height: 20px;"><strong>Home</strong>
        </a>
    </div>
    <div class="container py-5">
        <h2>{{ Auth::user()->name }}님의 마이페이지</h2>
        <p>이름: {{ Auth::user()->name }}</p>
        <p>이메일: {{ Auth::user()->email }}</p>

        <div class="logout-button">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-light btn-lg border-dark"><strong>로그아웃</strong></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
        
        <div class="row">
            @foreach(Auth::user()->posts as $post)
                <div class="col-md-3">
                    <div class="card">
                        <h3 class="card-header">
                            <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                        </h3>
                        <div class="card-body">
                            @if ($post->image)
                                @php
                                    $images = json_decode($post->image);
                                @endphp
                                @if ($images && count($images) > 0)
                                    <img src="{{ asset('storage/images/' . $images[0]) }}" alt="Post Image" class="img-fluid">
                                @else
                                    <img src="{{ asset('storage/images/default.png') }}" alt="Default Image" class="img-fluid">
                                @endif
                            @else
                                <img src="{{ asset('storage/images/default.png') }}" alt="Default Image" class="img-fluid">
                            @endif
                            <p class="mt-2">견종: {{ $post->breed }}</p>
                            <p>지역: {{ $post->location }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>