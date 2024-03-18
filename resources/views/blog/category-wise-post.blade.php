@extends('layouts.app')
@section('content')
    <h3>Thể loại: {{$category->name}}</h3>
    @forelse($posts as $post)
        <div class="col-md-12 nopadding">
            <div class="blog1-post-holder">
                <div class="image-holder">
                    <div class="post-info">
                        <span>
                            <i class="fa fa-user"></i> {{$category->name}}
                        </span>
                        <span><i class="fa fa-calendar"></i> {{$post->created_at->diffForHumans()}}</span>
                    </div>
                    <img src="{{$post->feature_image}}" alt="" class="img-responsive"/>
                </div>
                <div class="text-box-inner">
                    <h4 class="dosis uppercase less-mar3">
                        <a href="{{route('single-post', [$post->id])}}">{{$post->title}}</a>
                    </h4>
                    <div class="blog-post-info">
                        <span>
                            <i class="fa fa-user"></i> bởi {{$post->user->name}}
                        </span>
                        <span>
                            <i class="fa fa-comments-o"></i> 15 bình luận</span>
                    </div>
                    <br/>
                    <p>{{$post->excerpt}}</p>
                    <br/>
                    <br/>
                    <a href="{{route('single-post', [$post->slug])}}" class="btn btn-border yellow-green">Xem thêm</a> </div>
            </div>
        </div>
        <!--end post-->
    @empty
        <p>Không tìm thấy bài viết nào</p>
    @endforelse
    {{$posts->links('partials.paginator')}}
@endsection
