@section('title', 'Danh sách người dùng')
@extends('backend.layouts.master')
@section('content')

    @include('backend.layouts.success')

    <div class="d-flex justify-content-between">
        <a href="{{route('backend.user.create')}}" class="btn btn-primary rounded">Thêm</a>
    </div>
    <table class="table table-hover table-bordered table-dark">
        <tr>
            <th>Avatar</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Vai trò</th>
            <th>Hành động</th>
        </tr>
        @forelse($users as $user)
            <tr>
                <td><img src="{{$user->avatar}}" alt="{{$user->name}}" width="75px"></td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ strtoupper($user->roles[0]->name) }}</td>
                <td>
                    <a href="{{route('backend.user.edit', [$user->id])}}" class="btn btn-warning btn-sm rounded">
                        <i class="material-icons">edit</i>
                        Cập nhật
                    </a>
                    <form action="{{route('backend.user.destroy', [$user->id])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm rounded">
                            <i class="material-icons">delete</i>
                            Xóa
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr class="text-center">
                <td colspan="5">Không tìm thấy người dùng nào</td>
            </tr>
        @endforelse

    </table>
@endsection
