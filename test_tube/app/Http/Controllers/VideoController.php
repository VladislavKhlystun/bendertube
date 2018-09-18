<?php

namespace App\Http\Controllers;
use App\Video;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class VideoController extends Controller
{
    public function index() {
        $videos = Video::all();
    	return view('videos.index', compact('videos'));
    }

    public function showUploadPage() {
        return view('videos.upload');
    }

    public function singleVideo(Video $video) {
        $user = Auth::user();
        return view('videos.singleVideo', compact(['video', 'user']));
    }

    public function store(Request $request) {


        $this->validate($request, [
            'title' => 'required|max:255',
            'video_filename' => 'required|file|mimes:mp4' 
        ]);        

        $video = $request->file('video_filename');

       /*  $link = public_path(
            'videos/' . uniqid(\Auth::user()->id . '_') . '.mp4'
        );

       

        $video->move($link);
        $video_filename =  url(explode('public' . DIRECTORY_SEPARATOR , $link)[1]) ; */

        $video_filename = uniqid() . '.mp4';
        $video-> move(public_path() . '/videos' , $video_filename);
        $video_filename = 'videos/' . $video_filename;
        
        Video::create([
            'user_id' => \Auth::user()->id,
            'title' => $request['title'],
            'description' => $request['description'],
            'video_filename' => $video_filename,
        ]);

        session()->flash (
            'message', "You uploaded a new video, called " . $request['title'] . '.'
        );
        
        return redirect('/');
    }

   
}
