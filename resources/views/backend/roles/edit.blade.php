@section('title', 'Cập nhật vai trò')
@extends('backend.layouts.master')
@section('content')
    <div class="d-flex justify-content-between">
        <a href="{{route('backend.role.index')}}" class="btn btn-primary rounded">Danh sách vai trò</a>
    </div>
    <h3 class="text-center">
        Cập nhật vai trò {{$role->name}}
    </h3>
    <form action="{{route('backend.role.update', [$role->id])}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Vai trò</label>
            <input type="text" name="name" class="form-control" placeholder="Nhập tên vai trò" value="{{$role->name}}">
        </div>
        <button type="submit" class="btn btn-success btn-block rounded">Lưu</button>
    </form>
@endsection
