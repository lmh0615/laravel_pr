<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글 수정</title>
    <link href="https://fonts.googleapis.com/css2?family=Cute+Font&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Cute Font', cursive;
        }
    </style>
</head>
<body>
    <div class="fixed top-0 left-2/4 p-6 text-center z-10">
      <a href="<?php echo e(url('/')); ?>" class="btn btn-light btn-lg border-dark">
          <img src="<?php echo e(asset('storage/images/홈.png')); ?>" alt="home" style="width: 20px; height: 20px;">
          Home
      </a>
    </div>
    <div class="container py-5">
        <h2>게시글 수정</h2>
        <form action="<?php echo e(route('posts.update', $post)); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="form-group">
                <label for="title">제목</label>
                <input type="text" id="title" name="title" class="form-control" value="<?php echo e($post->title); ?>" required>
            </div>
            <div class="form-group">
                <label for="breed">견종</label>
                <input type="text" id="breed" name="breed" class="form-control" value="<?php echo e($post->breed); ?>" required>
            </div>
            <div class="form-group">
                <label for="location">지역</label>
                <input type="text" id="location" name="location" class="form-control" value="<?php echo e($post->location); ?>" required>
            </div>
            <div class="form-group">
                <label for="body">내용</label>
                <textarea id="body" name="body" class="form-control" required><?php echo e($post->body); ?></textarea>
            </div>
            <div class="form-group">
                <label for="image">이미지</label>
                <input type="file" id="image" name="image[]" class="form-control-file" multiple>
                <div id="preview"></div>
            </div>
            <button type="submit" class="btn btn-light btn-lg border-dark">수정하기</button>
        </form>
    </div>

    <script>
        var files = [];
        document.getElementById("image").addEventListener("change", function(e) {
            var preview = document.getElementById("preview");
    
            // 새로 선택한 파일들을 files 배열에 추가
            Array.from(e.target.files).forEach((file, index) => {
                files.push(file);
                var imgWrapper = document.createElement("div");
                var img = document.createElement("img");
                var removeBtn = document.createElement("button");
                img.src = URL.createObjectURL(file);
                img.height = 100;
                img.onload = function() {
                    URL.revokeObjectURL(img.src);
                }
                removeBtn.textContent = "X";
                // 취소 버튼 클릭시 해당 이미지와 파일 목록에서 제거
                removeBtn.addEventListener("click", function() {
                    files.splice(files.indexOf(file), 1);
                    preview.removeChild(imgWrapper);
                });
                imgWrapper.appendChild(img);
                imgWrapper.appendChild(removeBtn);
                preview.appendChild(imgWrapper);
            });
    
            // 파일 선택 창의 파일 목록을 files 배열로 교체
            e.target.files = new FileListItems(files);
        });
    
        // FileList 객체를 만들기 위한 클래스
        function FileListItems(files) {
            var b = new ClipboardEvent("").clipboardData || new DataTransfer();
            for (var i = 0, len = files.length; i<len; i++) b.items.add(files[i]);
            return b.files;
        }
    </script>
</body>
</html>
<?php /**PATH C:\Users\rhkda\OneDrive\Desktop\laravel_project\resources\views/posts/edit.blade.php ENDPATH**/ ?>