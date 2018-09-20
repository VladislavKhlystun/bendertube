@extends('layouts.app')

@section('content')

@include('layouts.categories')

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
        Uploaded at : {{$video->created_at->toFormattedDateString()}} by 
        <a href="http://localhost/{{$video->user->id}}/videos">{{$video->user->name}}</a>
    </div>

    <div>
        Category: <a href="/category/{{$video->category->id}}">{{$video->category->title}}</a>
    </div>

    <div class="panel-video__description">
        {{$video->description}}
    </div>

</div>
<hr>
<div class="comments">

    <span>Comments  ({{count($video->comments)}}) </span>

    @include('comments.makeComment')

    @include('comments.commentsToVideo')

</div>

@endsection