@extends('layouts.app')

@section('content')

<div class="panel-video">
    <video controls  width="100%" >
		<source src="{{url($video->video_filename)}}" type="video/mp4">
	</video>

    <div class="panel-video__title">
        <h1>
            {{$video->title}}
        </h1>
    </div>

    <div>
        Uploaded at : {{$video->created_at->toFormattedDateString()}}
    </div>

    <div class="panel-video__description">
        {{$video->description}}
    </div>

</div>
<hr>
<div class="comments">

    <span>Comments  ({{count($video->comments)}}) </span>

    <div class="leave-comment">
        <form action="/videos/{{$video->id}}/comments" method="POST" >
            {{csrf_field()}}
            <div class="form-group">
                <div>{{$user['name']}}</div>
                <input type="text" class="leave-comment-input" name="body" id="comment" placeholder="Leave a comment...">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Leave a comment</button>
            </div>
        </form>
    </div>
    @if (count($video->comments))
        @foreach ($video->comments as $comment)
            <div class="single-comment">
                <div class="single-comment__username">
                    <span>
                        {{$comment->user->name}}
                            @if ($comment->user->id == 2)
                                <i class="far fa-check-circle" style="margin-left: 5px;"></i>
                            @endif
                    </span>
                   
                    <span>{{$comment->created_at->diffForHumans()}}</span>
                </div>
                
                <div class="single-comment__commentbody">
                    {{$comment->body}}
                </div>
                
            </div>
        @endforeach
    @else 
        <h4 class="not_found">Nobody comment this video yet...</h4>
    @endif

</div>

@endsection