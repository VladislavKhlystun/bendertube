<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Video;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function show () {
    
    }

    public function store (Video $video) {
        
        Comment::create([
            'body' => request('body'),
            'user_id'=> \Auth::user()->id,
            'video_id' => $video->id
        ]);

        return back();
    }
}
