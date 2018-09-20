@extends('layouts.app')

@section('content')

     @if (count($videos))
    
    <h1>{{Auth::user()->name}} videos</h1>
     
     <div class="videos-block">
            @foreach ($videos as $video)
				<div class="single-video">
					<video controls  width="300px" height="150px">
						<source src="{{url($video->video_filename)}}" type="video/mp4">
					</video>

					<div class="single-video__title">
						<a href="http://localhost/videos/{{$video->id}}"> {{$video->title}} </a>
					</div>

					<div class="single-video__descr">
						<div>Description</div>
						<div>
							{{$video->description}}
						</div>
					</div>

					<div class="panel-video__count-comments">
						Comments ({{count($video->comments)}})
					</div>
                    @if ($videos->first->user->user->id == Auth::id())
                        <a href="/video/{{$video->id}}/edit">Edit</a>
                        <button type="submit">delete</button>
                    @endif
                </div>
               
			@endforeach
		@else 
            <h3 class="not_found" >There is no videos uploaded yet...</h3>
        </div>
		@endif
@endsection