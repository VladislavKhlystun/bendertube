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
    <hr>
    <div>
        <div>{{$user['name']}}</div>
        <input type="text" class="comment-input" name="comment" id="comment" placeholder="Leave a comment...">
    </div>
    @if (count($video->comments))
        @foreach ($video->comments as $comment)
            
        @endforeach
    @else 
        <h4 class="not_found">Nobody comment this video yet...</h4>
    @endif
</div>

@endsection