@section('title', 'Thùng rác bài viết')
@extends('backend.layouts.master')
@section('content')

    @include('backend.layouts.success')

    <div class="d-flex justify-content-between">
        <a href="{{route('backend.posts.index')}}"
           class="btn btn-primary rounded">Danh sách bài viết</a>
    </div>
    <table class="table table-hover table-bordered table-dark">
        <tr>
            <th>Ảnh đại diện</th>
            <th>Tiêu đề</th>
            <th>Đường dẫn</th>
            <th>Thể loại</th>
            <th>Hành động</th>
        </tr>
        @forelse($posts as $post)
            <tr>
                <td><img width="75px" src="{{$post->feature_image}}" alt="{{$post->title}}"></td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->slug }}</td>
                <td>{{$post->category->name}}</td>
                <td class="d-flex">
                    <form action="{{route('backend.posts.restore', [$post->id])}}" method="post">
                        @csrf
                        <button class="btn btn-warning btn-sm rounded">
                            <i class="material-icons">restore</i>
                            Khôi phục
                        </button>
                    </form>
                    <form action="{{route('backend.posts.force.delete', [$post->id])}}" method="post">
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
                <td colspan="5">Không tìm thấy bài viết nào trong thùng rác</td>
            </tr>
        @endforelse

    </table>
@endsection
