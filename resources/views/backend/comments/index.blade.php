@section('title', 'Danh sách bình luận')
@extends('backend.layouts.master')
@section('content')

    @include('backend.layouts.success')
    <h2>Tất cả bình luận</h2>
    <table class="table table-hover table-bordered table-dark">
        <tr>
            <th>Tên</th>
            <th>Bình luận</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
        @forelse($comments as $comment)
            <tr>
                <td>
                    <p class="font-weight-bold">{{$comment->name}} </p>
                    <p>{{$comment->email}} </p>
                </td>
                <td>{{$comment->comment}}</td>
                <td>{{$comment->status}}</td>
                <td >
                    @if($comment->status === 'pending')
                        <form action="{{route('backend.comments.approve', [$comment->id])}}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-sm rounded">
                                <i class="material-icons">done_outline</i>
                                Phê duyệt
                            </button>
                        </form>
                    @endif
                    <div>
                        <a href="{{route('backend.comments.edit', [$comment->id])}}" class="btn btn-warning btn-sm rounded">
                            <i class="material-icons">edit</i>
                            Cập nhật
                        </a>
                    </div>
                    <form action="{{route('backend.comments.destroy', [$comment->id])}}" method="post">
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
            <tr>
                <td colspan="4">Không tìm thấy bình luận nào</td>
            </tr>
        @endforelse

    </table>
@endsection
