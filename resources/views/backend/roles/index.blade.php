@section('title', 'Danh sách vai trò')
@extends('backend.layouts.master')
@section('content')
    @if(session('success'))
        <div class="alert alert-success" role="alert">
           {{session('success')}}
        </div>
    @endif
    <div class="d-flex justify-content-between">
        <a href="{{route('backend.role.create')}}" class="btn btn-primary rounded">Thêm</a>
    </div>
    <table class="table table-hover table-bordered table-dark">
        <tr>
            <th>Tên</th>
            <th>Hành động</th>
        </tr>
        @forelse($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>
                    <a href="{{route('backend.role.edit', [$role->id])}}" class="btn btn-warning btn-sm rounded">
                        <i class="material-icons">edit</i>
                        Cập nhật
                    </a>
                    <form action="{{route('backend.role.destroy', [$role->id])}}" method="post">
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
                <td colspan="4">Không tìm thấy vai trò nào</td>
            </tr>
        @endforelse

    </table>
@endsection
