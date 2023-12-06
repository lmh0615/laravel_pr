<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글 목록</title>
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
    </style>
</head>
<body>
    <div class="fixed top-0 left-2/4 p-6 text-center z-10">
        <a href="{{ url('/') }}" class="btn btn-light btn-lg border-dark">
            <img src="storage/images/홈.png" alt="home" style="height: 20px;"> <strong>Home</strong>
        </a>
    </div>
    <div class="container py-5">
        <h2>LIST</h2>
        <div class="row">
            @foreach($posts as $post)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
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
                            <p class="mt-2">종류 : {{ $post->breed }}</p>
                            <p>지역 : {{ $post->location }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>