@section('title', 'Danh sách vai trò')
@extends('backend.layouts.master')
@section('content')

    @include('backend.layouts.success')

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
                <td class="d-flex">
                    <a href="{{route('backend.role.assign.permission', [$role->id])}}" class="btn btn-success btn-sm rounded">
                        <i class="material-icons">connect_without_contact</i>
                        Gán quyền
                    </a>
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
