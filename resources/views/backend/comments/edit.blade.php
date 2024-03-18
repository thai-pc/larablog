@section('title', 'Cập nhật bình luận')
@extends('backend.layouts.master')
@section('content')
    <div class="d-flex justify-content-between">
        <a href="{{route('backend.comments.index')}}" class="btn btn-primary rounded">Danh sách bình luận</a>
    </div>
    <h3 class="text-center">
        Cập nhật bình luận của người dùng {{$comment->name}}
    </h3>
    <form action="{{route('backend.comments.update', [$comment->id])}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nội dung bình luận</label>
            <textarea
                id="name"
                class="form-control"
                name="comment"
            >{{$comment->comment}}</textarea>
        </div>
        <button
            class="btn btn-primary btn-block rounded mt-2"
            type="submit">Cập nhật</button>
    </form>
@endsection
