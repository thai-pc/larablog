@section('title', 'Thêm mới bài viết')
@extends('backend.layouts.master')
@section('content')
    <div class="d-flex justify-content-between">
        <a href="{{route('backend.posts.index')}}" class="btn btn-primary rounded">Danh sách bài viết</a>
    </div>
    <h3 class="text-center">
        Thêm mới bài viết
    </h3>
    <form action="{{ route('backend.posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Tiêu đề</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                   placeholder="Nhập tiêu đề bài viết">
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="excerpt">Đoạn trích</label>
            <textarea
                name="excerpt"
                id="excerpt"
                class="form-control @error('excerpt') is-invalid @enderror"
            ></textarea>
            @error('excerpt')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="post_content">Nội dung</label>
            <textarea
                name="post_content"
                id="post_content"
                class="form-control @error('content') is-invalid @enderror"
                cols="30"
                rows="10"
            ></textarea>
            @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="category_id">Thể loại</label>
            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                <option value="">Vui lòng chọn thể loại</option>
                @forelse($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @empty
                @endforelse
            </select>
            @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="tags">Từ khóa</label>
            <select class="form-control mutiple-tag" name="tags[]" multiple="multiple">
            </select>
            @error('tags')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <label for="feature_image">Ảnh đại diện</label>
        <div class="form-file-group my-2">
            <input type="file" name="feature_image" id="file-upload" style="display: none">
            <p>Kéo thả hoặc click vào khu vục này để tải ảnh lên</p>
        </div>
        @error('feature_image')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <div id="previewBox" class="my-2" style="display: none">
            <img src="" alt="" id="previewImg" width="300px" class="img-fluid rounded">
            <i class="material-icons">delete</i>
        </div>
        <button type="submit" class="btn btn-primary rounded"
                value="draft" name="status">Lưu nháp
        </button>
        <button type="submit" class="btn btn-success rounded"
                value="publish" name="status">Công khai
        </button>
    </form>

@endsection
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .form-file-group {
            width: 100%;
            height: 200px;
            border: 4px dashed #000;
        }

        .form-file-group p {
            text-align: center;
            width: 100%;
            height: 100%;
            line-height: 200px;
            cursor: pointer;
        }
        #previewBox i{
            cursor: pointer;
        }
    </style>
@endsection
@section('scripts')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('post_content', {
            filebrowserImageBrowseUrl: '/ckfinder/ckfinder.html?type=Images',
            filebrowserImageUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserBrowseUrl: "{{ route('backend.posts.upload') }}",
            filebrowserUploadMethod: 'form',
            filebrowserUploadUrl: "{{ route('backend.posts.upload', ['_token' => csrf_token()]) }}",
        });
    </script>
    <script>
        $(document).on('click', '.form-file-group p', () => {
            $('#file-upload').click();
        })
        $(document).on('change', '#file-upload', function () {
            let file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function () {
                    $("#previewImg").attr('src', reader.result);
                    $("#previewBox").css('display', 'block');
                };
                $(".form-file-group").css('display', 'none');
                reader.readAsDataURL(file);
            }
        });
        $(document).on('click', '#previewBox i', () => {
            $("#previewImg").attr('src', "");
            $("#previewBox").css('display', 'none');
            $(".form-file-group").css('display', 'block');
        })

    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(".mutiple-tag").select2({
            tags: true,
            tokenSeparators: [','],
            placeholder: "Vui lòng nhập từ khóa bài viết",
            allowClear: true
        })
    </script>
@endsection
