@section('title', 'Cập nhật vai trò')
@extends('backend.layouts.master')
@section('content')
    <div class="d-flex justify-content-between">
        <a href="{{route('backend.categories.index')}}" class="btn btn-primary rounded">Danh sách vai trò</a>
    </div>
    <h3 class="text-center">
        Cập nhật vai trò {{$category->name}}
    </h3>
    <form action="{{route('backend.categories.update', [$category->id])}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Thể loại</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   placeholder="Nhập tên vai trò" value="{{$category->name}}">
        </div>
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-success btn-block rounded mt-2">Cập nhật</button>
    </form>
@endsection
