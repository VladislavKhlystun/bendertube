<?php

namespace App\Services;

use App\Services\VideoMagicInterface;

class VideoMagicService implements VideoMagicInterface {

    public function makeDiffResolutions (string $video_filename) {
        $ffmpeg = \FFMpeg\FFMpeg::create([
            'ffmpeg.binaries'  => env('FFMPEG_BINARIES'),
            'ffprobe.binaries' => env('FFPROBE_BINARIES'),
            'timeout'          => 3600, // The timeout for the underlying process
            'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use
        ]);

        $video = $ffmpeg->open(
            public_path($video_filename)
        );

        $frame = $video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(28));
        $frame->save('image.jpg');

    }
}