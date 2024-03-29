@section('title', 'Thêm mới người dùng')
@extends('backend.layouts.master')
@section('content')
    <div class="d-flex justify-content-between">
        <a href="{{route('backend.categories.index')}}" class="btn btn-primary rounded">Danh sách vai trò</a>
    </div>
    <h3 class="text-center">
        Thêm mới thể loại
    </h3>
    <form action="{{ route('backend.categories.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                   placeholder="Nhập tên thể loại">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success rounded mt-2">Lưu</button>
    </form>

@endsection
