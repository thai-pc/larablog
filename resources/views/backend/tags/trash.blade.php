@section('title', 'Thùng rác từ khóa')
@extends('backend.layouts.master')
@section('content')

    @include('backend.layouts.success')

    <div class="d-flex justify-content-between">
        <a href="{{route('backend.tags.index')}}"
           class="btn btn-primary rounded">Danh sách từ khóa</a>
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
                    <form action="{{route('backend.tags.restore', [$tag->id])}}" method="post">
                        @csrf
                        <button class="btn btn-warning btn-sm rounded">
                            <i class="material-icons">restore</i>
                            Khôi phục
                        </button>
                    </form>
                    <form action="{{route('backend.tags.force.delete', [$tag->id])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm rounded">
                            <i class="material-icons">delete</i>
                            Tiếp tục xóa
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr class="text-center">
                <td colspan="4">Không tìm thấy từ khóa nào trong thùng rác</td>
            </tr>
        @endforelse

    </table>
@endsection
