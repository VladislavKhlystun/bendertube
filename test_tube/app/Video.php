<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;  

class Video extends Model
{
    protected $fillable = [
        'title',
        'description',
        'video_filename',
        'user_id',
        'category_id'
    ];
    
    public function user() {
       return $this->belongsTo('App\User');
    }

    public function comments () {
        return $this->hasMany('App\Comment');
    }
   
    public function category () {
        return $this->belongsTo('App\Category');
    }
}
