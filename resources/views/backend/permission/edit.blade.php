@section('title', 'Cập nhật quyền')
@extends('backend.layouts.master')
@section('content')
    <div class="d-flex justify-content-between">
        <a href="{{route('backend.permission.index')}}" class="btn btn-primary rounded">Danh sách quyền</a>
    </div>
    <h3 class="text-center">
        Cập nhật vai trò {{$permission->name}}
    </h3>
    <form action="{{route('backend.permission.update', [$permission->id])}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Quyền</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   placeholder="Nhập tên quyền" value="{{$permission->name}}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success btn-block rounded mt-2">Lưu</button>
    </form>
@endsection
