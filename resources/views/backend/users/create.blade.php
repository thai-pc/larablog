@section('title', 'Thêm mới người dùng')
@extends('backend.layouts.master')
@section('content')
    <div class="d-flex justify-content-between">
        <a href="{{route('backend.user.index')}}" class="btn btn-primary rounded">Danh sách người dùng</a>
    </div>
    <h3 class="text-center">
        Thêm mới người dùng
    </h3>
    <form action="{{ route('backend.user.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nhập tên người dùng">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Nhập email người dùng">
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Nhập mật khẩu người dùng">
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="roles">Vai trò</label>
            <select name="role_id" class="form-control @error('role_id') is-invalid @enderror">
                <option value="0">Vui lòng chọn vai trò</option>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ strtoupper($role->name) }}</option>
                @endforeach
            </select>
            @error('role_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="avatar">Avatar</label>
            <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror">
            @error('avatar')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success btn-block rounded">Lưu</button>
    </form>


@endsection
