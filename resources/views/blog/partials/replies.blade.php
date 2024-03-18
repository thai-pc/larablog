<div class="blog1-post-info-box less-width pull-right" style="margin-top: 5px; margin-bottom: 5px">
    <div class="text-box border padding-3">
        <div class="text-box-right" style="padding: 0 0 0 50px">
            <h5 class="uppercase dosis less-mar2">{{$reply->name}}</h5>
            <div class="blog1-post-info"><span>{{$reply->created_at->diffForHumans()}}</span></div>
            <p class="paddtop1">{{$reply->comment}}</p>
            <br/>
            <a
                class="btn btn-border yellow-green btn-small-2 "
                href="#comment-form"
                onclick="document.getElementById('comment_id').value = {{$comment->id}}"
            >
                Phản hồi
            </a>
        </div>
    </div>
</div>
<!--end item-->
<div class="clearfix"></div>
