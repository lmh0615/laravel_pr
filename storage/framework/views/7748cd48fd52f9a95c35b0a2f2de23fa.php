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
        <a href="<?php echo e(url('/')); ?>" class="btn btn-light btn-lg border-dark">
            <img src="storage/images/홈.png" alt="home" style="height: 20px;"><strong>Home</strong>
        </a>
    </div>
    <div class="container py-5">
        <h2><?php echo e(Auth::user()->name); ?>님의 마이페이지</h2>
        <p>이름: <?php echo e(Auth::user()->name); ?></p>
        <p>이메일: <?php echo e(Auth::user()->email); ?></p>

        <div class="logout-button">
            <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-light btn-lg border-dark"><strong>로그아웃</strong></a>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
            </form>
        </div>
        
        <div class="row">
            <?php $__currentLoopData = Auth::user()->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3">
                    <div class="card">
                        <h3 class="card-header">
                            <a href="<?php echo e(route('posts.show', $post->id)); ?>"><?php echo e($post->title); ?></a>
                        </h3>
                        <div class="card-body">
                            <?php if($post->image): ?>
                                <?php
                                    $images = json_decode($post->image);
                                ?>
                                <?php if($images && count($images) > 0): ?>
                                    <img src="<?php echo e(asset('storage/images/' . $images[0])); ?>" alt="Post Image" class="img-fluid">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('storage/images/default.png')); ?>" alt="Default Image" class="img-fluid">
                                <?php endif; ?>
                            <?php else: ?>
                                <img src="<?php echo e(asset('storage/images/default.png')); ?>" alt="Default Image" class="img-fluid">
                            <?php endif; ?>
                            <p class="mt-2">견종: <?php echo e($post->breed); ?></p>
                            <p>지역: <?php echo e($post->location); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\Users\rhkda\OneDrive\Desktop\laravel_project\resources\views/dashboard.blade.php ENDPATH**/ ?>