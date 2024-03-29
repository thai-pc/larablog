@section('title', 'Danh sách từ khóa')
@extends('backend.layouts.master')
@section('content')

    @include('backend.layouts.success')

    <div class="d-flex justify-content-between">
        <a href="{{route('backend.tags.create')}}"
           class="btn btn-primary rounded">Thêm</a>
        <a href="{{route('backend.tags.trash')}}"
           class="btn btn-danger rounded">Thùng rác</a>
    </div>
    <table class="table table-hover table-bordered table-dark">
        <tr>
            <th>Tên</th>
            <th>Đường dẫn</th>
            <th>Hành động</th>
        </tr>
        @forelse($tags as $tag)
            <tr>
                <td>{{ $tag->name }}</td>
                <td>{{ $tag->slug }}</td>
                <td class="d-flex">
                    <a href="{{route('backend.tags.edit', [$tag->id])}}"
                       class="btn btn-warning btn-sm rounded">
                        <i class="material-icons">edit</i>
                        Cập nhật
                    </a>
                    <form action="{{route('backend.tags.destroy', [$tag->id])}}" method="post">
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
                <td colspan="4">Không tìm thấy từ khóa nào</td>
            </tr>
        @endforelse

    </table>
@endsection
