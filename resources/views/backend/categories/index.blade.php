@section('title', 'Danh sách thể loại')
@extends('backend.layouts.master')
@section('content')

    @include('backend.layouts.success')

    <div class="d-flex justify-content-between">
        <a href="{{route('backend.categories.create')}}"
           class="btn btn-primary rounded">Thêm</a>
        <a href="{{route('backend.categories.trash')}}"
           class="btn btn-danger rounded">Thùng rác</a>
    </div>
    <table class="table table-hover table-bordered table-dark">
        <tr>
            <th>Tên</th>
            <th>Đường dẫn</th>
            <th>Hành động</th>
        </tr>
        @forelse($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td class="d-flex">
                    <a href="{{route('backend.categories.edit', [$category->id])}}"
                       class="btn btn-warning btn-sm rounded">
                        <i class="material-icons">edit</i>
                        Cập nhật
                    </a>
                    <form action="{{route('backend.categories.destroy', [$category->id])}}" method="post">
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
                <td colspan="4">Không tìm thấy thể loại nào</td>
            </tr>
        @endforelse

    </table>
@endsection
