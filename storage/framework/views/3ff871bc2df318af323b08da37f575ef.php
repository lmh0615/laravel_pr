<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($post->title); ?></title>
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
        <a href="<?php echo e(url('/')); ?>" class="btn btn-light btn-lg border-dark">
            <img src="<?php echo e(asset('storage/images/홈.png')); ?>" alt="home" style="width: 20px; height: 20px;">
            <strong>Home</strong>
        </a>
    </div>
    <div class="container my-5">
        <h2 class="mb-4"><?php echo e($post->title); ?></h2>
        <p><small class="text-muted">작성자 : <?php echo e($post->user->email); ?></small></p>
        <p class="mt-2">종류 : <?php echo e($post->breed); ?></p>
        <p>지역 : <?php echo e($post->location); ?></p>
        <p class="mb-2">내용 :</p>
        <div class="card">
            <div class="card-body">
                <?php echo e($post->body); ?>

            </div>
        </div>
        <?php if($post->image): ?>
            <?php
                $images = json_decode($post->image);
            ?>
            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <img src="<?php echo e(asset('storage/images/' . $image)); ?>" alt="Post Image" class="img-fluid my-3">
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <p><small class="text-muted">작성시간 : <?php echo e($post->created_at); ?></small></p>

        <h3 class="mt-5">댓글</h3>
        <form action="<?php echo e(route('comments.store', $post->id)); ?>" method="post" class="mb-4">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <textarea name="body" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-light btn-lg border-dark">댓글 작성</button>
        </form>

        <ul class="list-unstyled">
            <?php $__currentLoopData = $post->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="mb-3 border-bottom pb-3">
                    <p><strong><?php echo e($comment->user->name); ?></strong></p>
                    <p><?php echo e($comment->body); ?></p>

                    <?php if(Auth::user()->id == $comment->user_id || (Auth::user()->name == '관리자' && Auth::user()->email == 'root@gmail.com')): ?>
                        <form action="<?php echo e(route('comments.destroy', $comment->id)); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm">X</button>
                        </form>
                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        <?php if(Auth::user()->id == $post->user_id || (Auth::user()->name == '관리자' && Auth::user()->email == 'root@gmail.com')): ?>
            <form action="<?php echo e(route('posts.destroy', $post->id)); ?>" method="post" class="mt-5">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-light btn-lg border-dark">게시글 삭제</button>
            </form>
            <a href="<?php echo e(route('posts.edit', $post->id)); ?>" class="btn btn-light btn-lg border-dark mt-5">게시글 수정</a>
        <?php endif; ?>
    </div>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\Users\rhkda\OneDrive\Desktop\laravel_project\resources\views/posts/show.blade.php ENDPATH**/ ?>