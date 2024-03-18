@section('title', 'Cập nhật người dùng')
@extends('backend.layouts.master')
@section('content')
    <div class="d-flex justify-content-between">
        <a href="{{route('backend.user.index')}}" class="btn btn-primary rounded">Danh sách người dùng</a>
    </div>
    <h3 class="text-center">
        Cập nhật người dùng {{$user->name}}
    </h3>
    <form action="{{route('backend.user.update', [$user->id])}}" method="post" id="user-update">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="roles">Vai trò</label>
            <select name="role_id" id="role_id" class="form-control">
                @foreach($roles as $role)
                    <option value="{{$role->name}}" @if($role->id === $user->role_id) selected @endif>{{strtoupper($role->name)}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success btn-block rounded mt-2">Cập nhật</button>
    </form>
@endsection
