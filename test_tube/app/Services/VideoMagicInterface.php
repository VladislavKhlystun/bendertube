<?php

namespace App\Services;

interface VideoMagicInterface {
    public function makeDiffResolutions (string $video_filename);
}