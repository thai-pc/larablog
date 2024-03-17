@section('title', 'Danh sách quyền')
@extends('backend.layouts.master')
@section('content')

    @include('backend.layouts.success')

    <div class="d-flex justify-content-between">
        <a href="{{route('backend.permission.create')}}" class="btn btn-primary rounded">Thêm</a>
    </div>
    <table class="table table-hover table-bordered table-dark">
        <tr>
            <th>Tên</th>
            <th>Hành động</th>
        </tr>
        @forelse($permissions as $permission)
            <tr>
                <td>{{ $permission->name }}</td>
                <td>
                    <a href="{{route('backend.permission.edit', [$permission->id])}}" class="btn btn-warning btn-sm rounded">
                        <i class="material-icons">edit</i>
                        Cập nhật
                    </a>
                    <form action="{{route('backend.permission.destroy', [$permission->id])}}" method="post">
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
                <td colspan="4">Không tìm thấy quyền nào</td>
            </tr>
        @endforelse

    </table>
@endsection
