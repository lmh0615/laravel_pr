<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cute+Font&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Cute Font', cursive;
            font-size: 30px; 
        }
        h2 {
            font-size: 45px; 
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.2);
        }
        .fixed-top {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body>
    <div class="fixed top-0 left-2/4 p-6 text-center z-10">
        <a href="{{ url('/') }}" class="btn btn-light btn-lg border-dark">
            <img src="{{ asset('storage/images/홈.png') }}" alt="home" style="width: 20px; height: 20px;">
            <strong>Home</strong>
        </a>
    </div>
    <div class="container my-5">
        <h2 class="mb-4">{{ $post->title }}</h2>
        <p><small class="text-muted">작성자 : {{ $post->user->email }}</small></p>
        <p class="mt-2">종류 : {{ $post->breed }}</p>
        <p>지역 : {{ $post->location }}</p>
        <p class="mb-2">내용 :</p>
        <div class="card">
            <div class="card-body">
                {{ $post->body }}
            </div>
        </div>
        @if ($post->image)
            @php
                $images = json_decode($post->image);
            @endphp
            @foreach($images as $image)
                <img src="{{ asset('storage/images/' . $image) }}" alt="Post Image" class="img-fluid my-3">
            @endforeach
        @endif
        <p><small class="text-muted">작성시간 : {{ $post->created_at }}</small></p>

        <h3 class="mt-5">댓글</h3>
        <form action="{{ route('comments.store', $post->id) }}" method="post" class="mb-4">
            @csrf
            <div class="form-group">
                <textarea name="body" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-light btn-lg border-dark">댓글 작성</button>
        </form>

        <ul class="list-unstyled">
            @foreach($post->comments as $comment)
                <li class="mb-3 border-bottom pb-3">
                    <p><strong>{{ $comment->user->name }}</strong></p>
                    <p>{{ $comment->body }}</p>

                    @if (Auth::user()->id == $comment->user_id || (Auth::user()->name == '관리자' && Auth::user()->email == 'root@gmail.com'))
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">X</button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>

        @if (Auth::user()->id == $post->user_id || (Auth::user()->name == '관리자' && Auth::user()->email == 'root@gmail.com'))
            <form action="{{ route('posts.destroy', $post->id) }}" method="post" class="mt-5">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-light btn-lg border-dark">게시글 삭제</button>
            </form>
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-light btn-lg border-dark mt-5">게시글 수정</a>
        @endif
    </div>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>