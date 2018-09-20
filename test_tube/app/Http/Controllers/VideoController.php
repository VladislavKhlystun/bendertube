<?php

namespace App\Http\Controllers;
use App\Video;
use App\User;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\VideoMagicInterface;


class VideoController extends Controller
{
    public function index() {
    	return view('videos.index');
    }

    public function showUploadPage() {
        return view('videos.upload');
    }

    public function singleVideo(Video $video) {
        return view('videos.singleVideo', compact('video'));
    }

    public function store(Request $request, VideoMagicInterface $videoService) {
        $this->validate($request, [
            'title' => 'required|max:255',
            'video_filename' => 'required|file|mimes:mp4',
            'category' => 'required' 
        ]);        

        $video = $request->file('video_filename');

         /* $link = public_path(
            'videos/'
        ) . uniqid(\Auth::user()->id . '_') . '.mp4';
        $video->move($link);
        $video_filename =  url(explode('public' . DIRECTORY_SEPARATOR , $link)[1]) ;  */

        $video_filename = uniqid() . '.mp4';
        $video-> move(public_path() . '/videos' , $video_filename);
        $video_filename = 'videos/' . $video_filename;
        
        /*резать на разрешения */

        //$video_filename
     
        //--------------------------------
        
        $videoService->makeDiffResolutions($video_filename);
        
        Video::create([
            'user_id' => \Auth::user()->id,
            'title' => $request['title'],
            'description' => $request['description'],
            'video_filename' => $video_filename,
            'category_id' => $request['category']
        ]);

        session()->flash (
            'message', "You uploaded a new video, called " . $request['title'] . '.'
        );
        
        return redirect('/');
    }

    public function categoryVideos(Category $category) {
        $videos = $category->videos;
        return view('videos.categoryVideos', compact('videos'));
    }   

    public function userVideos(User $user) {
        $videos = $user->videos;
        return view('videos.userVideos', compact('videos'));
    }
   
    public function edit(Video $video) {
        return view('videos.edit');
    }

}
