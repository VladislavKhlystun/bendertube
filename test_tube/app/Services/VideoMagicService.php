<?php

namespace App\Services;

use App\Services\VideoMagicInterface;
use FFMpeg\Filters\Video\RotateFilter;

class VideoMagicService implements VideoMagicInterface {

    public function createInstanceFFmpeg () {
        $ffmpeg = \FFMpeg\FFMpeg::create([
            'ffmpeg.binaries'  => env('FFMPEG_BINARIES'),
            'ffprobe.binaries' => env('FFPROBE_BINARIES'),
            'timeout'          => 3600, // The timeout for the underlying process
            'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use
        ]);

        return $ffmpeg;
    }

    public function moveResizedFileToPath (string $video_filename, string $RES) {
        
        $new_path = 'videos/'. $RES . '/' . $video_filename;        // making a string with new path
       
        if (!is_dir(public_path() . '/videos/' . $RES)) {
            mkdir('videos/' . $RES , 0700);         //checking if folder exists
        }

        rename($video_filename, $new_path); // moving file to a new path
        return true;
    }


    public function makeDiffResolutions (string $video_filename) {
       
        $ffmpeg = self::createInstanceFFmpeg();

        $resolutions = [
            [320, 240],
            [640, 480],
            [1280, 720],
            [1920, 1080]
        ];


        foreach($resolutions as $res) {
            $video = $ffmpeg->open(
                public_path($video_filename)         // opening file from public/videos
            );

            list($width, $height) = $res;
            
            $video->filters()
                    ->resize(new \FFMpeg\Coordinate\Dimension($width, $height))  // resizing video to needed dimension
                    ->synchronize();
    
            $video_filename = str_replace('videos/', '' , $video_filename);     // removing '/public' from filename
            //-------
            $source = new \FFMpeg\Format\Video\X264();

            $source->on('progress', function ($video, $source, $percentage) {
                echo "$percentage % transcoded";
            });
            //-----------

            $video->save($source, $video_filename);     // saving resized file into 'public' path $video->save(new \FFMpeg\Format\Video\X264(), $video_filename);  
    
            self::moveResizedFileToPath($video_filename, "{$width}x{$height}");

            $video_filename = 'videos/' . $video_filename;  // adding videos/ for the next iteration 

        }

        return true;
    }
}