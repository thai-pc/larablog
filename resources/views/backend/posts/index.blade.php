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
                <td>
                    <div>
                        <a href="{{route('single-post', [$post->slug])}}" target="_blank"
                           class="btn btn-success btn-sm rounded">
                            <i class="material-icons">remove_red_eye</i>
                            Xem
                        </a>
                    </div>
                    @can('update', $post)
                        <div>
                            <a href="{{route('backend.posts.edit', [$post->id])}}" class="btn btn-warning btn-sm rounded">
                                <i class="material-icons">edit</i>
                                Cập nhật
                            </a>
                        </div>
                    @endcan
                    @can('delete', $post)
                        <form action="{{route('backend.posts.destroy', [$post->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm rounded">
                                <i class="material-icons">delete</i>
                                Xóa
                            </button>
                        </form>
                    @endcan
                </td>
            </tr>
        @empty
            <tr class="text-center">
                <td colspan="5">Không tìm thấy bài viết nào</td>
            </tr>
        @endforelse

    </table>
@endsection
