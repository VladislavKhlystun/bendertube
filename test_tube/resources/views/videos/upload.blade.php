@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1> Upload Video </h1>
            <form method="POST" enctype="multipart/form-data" action="/upload">
                {{csrf_field()}}

                <div class="form-group">
                    <label for="title">Video Title</label>
                    <input type="text" name="title" placeholder="The title of video...">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="text" name="description" placeholder="Video description..."> </textarea>
                </div>

                <div class="form-group">
                    <label for="video_filename">Choose a file</label>
                    <input type="file" name="video_filename" id="video_filename">
                </div>

                <div class="form-group">
                    <button type="submit"> Upload </button>
                </div>
            </form>
        </div>
    </div>
@endsection