@section('title', 'Thêm mới người dùng')
@extends('backend.layouts.master')
@section('content')
    <div class="d-flex justify-content-between">
        <a href="{{route('backend.role.index')}}" class="btn btn-primary rounded">Danh sách vai trò</a>
    </div>
    <h3 class="text-center">
        Thêm mới vai trò
    </h3>
    <form action="{{ route('backend.role.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nhập tên vai trò">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success rounded">Lưu</button>
    </form>

@endsection
