@section('title', 'Thêm mới bài viết')
@extends('backend.layouts.master')
@section('content')
    <div class="d-flex justify-content-between">
        <a href="{{route('backend.posts.index')}}" class="btn btn-primary rounded">Danh sách bài viết</a>
    </div>
    <h3 class="text-center">
        Thêm mới bài viết
    </h3>
    <form action="{{ route('backend.posts.store') }}" method="post">
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
            <select name="category_id" id="category_id" class="form-control">
                <option value="0">Vui lòng chọn thể loại</option>
                @forelse($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @empty
                @endforelse
            </select>
            @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary rounded"
                value="draft" name="status">Lưu nháp</button>
        <button type="submit" class="btn btn-success rounded"
                value="publish" name="status">Công khai</button>
    </form>

@endsection
