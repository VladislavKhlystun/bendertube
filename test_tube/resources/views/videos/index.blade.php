@extends('layouts.app')

@section('content')

	<div class="videos-block">
	 @if (count($videos))
			@foreach ($videos as $video)
				<div class="single-video">
					<video controls  width="300px" height="150px">
						<source src="{{url($video->video_filename)}}" type="video/mp4">
					</video>

					<div class="single-video__title">
						<a href="videos/{{$video->id}}"> {{$video->title}} </a>
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
				</div>
			@endforeach
		@else 
			<h3 class="not_found" >There is no videos uploaded yet...</h3>
		@endif
	</div>
@endsection