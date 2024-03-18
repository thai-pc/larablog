@section('title', 'Thêm mới từ khóa')
@extends('backend.layouts.master')
@section('content')
    <div class="d-flex justify-content-between">
        <a href="{{route('backend.tags.index')}}" class="btn btn-primary rounded">Danh sách từ khóa</a>
    </div>
    <h3 class="text-center">
        Thêm mới từ khóa
    </h3>
    <form action="{{ route('backend.tags.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                   placeholder="Nhập tên từ khóa">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success rounded mt-2">Lưu</button>
    </form>

@endsection
