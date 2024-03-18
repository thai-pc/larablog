@section('title', 'Thêm mới quyền')
@extends('backend.layouts.master')
@section('content')
    <div class="d-flex justify-content-between">
        <a href="{{route('backend.permission.index')}}" class="btn btn-primary rounded">Danh sách quyền</a>
    </div>
    <h3 class="text-center">
        Thêm mới quyền
    </h3>
    <form action="{{ route('backend.permission.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nhập tên quyền">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success btn-block rounded mt-2">Lưu</button>
    </form>

@endsection
