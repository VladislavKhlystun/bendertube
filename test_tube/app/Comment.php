<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Comment extends Model
{
    protected $fillable = ['body', 'user_id', 'video_id'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function video () {
        return $this->belongsTo('App\Video');
    }


}
