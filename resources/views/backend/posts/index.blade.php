@section('title', 'Danh sách bài viết')
@extends('backend.layouts.master')
@section('content')

    @include('backend.layouts.success')

    <div class="d-flex justify-content-between">
        <a href="{{route('backend.posts.create')}}"
           class="btn btn-primary rounded">Thêm</a>
        <a href="{{route('backend.posts.trash')}}"
           class="btn btn-danger rounded">Thùng rác</a>
    </div>
    <table class="table table-hover table-bordered table-dark">
        <tr>
            <th>Tiêu đề</th>
            <th>Đường dẫn</th>
            <th>Hành động</th>
        </tr>
        @forelse($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->slug }}</td>
                <td class="d-flex">
                    <a href="{{route('backend.posts.edit', [$post->id])}}"
                       class="btn btn-warning btn-sm rounded">
                        <i class="material-icons">edit</i>
                        Cập nhật
                    </a>
                    <form action="{{route('backend.posts.destroy', [$post->id])}}" method="post">
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
                <td colspan="4">Không tìm thấy bài viết nào</td>
            </tr>
        @endforelse

    </table>
@endsection
