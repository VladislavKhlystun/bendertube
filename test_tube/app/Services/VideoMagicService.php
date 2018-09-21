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
        
        $new_path = 'videos/'. $RES . '/' . $video_filename; // making a string with new path
       
        if (!is_dir(public_path() . '/videos/' . $RES)) {
            mkdir('videos/' . $RES , 0700);  //checking if folder exists
        }

        rename($video_filename, $new_path); // moving file to a new path
        return true;
    }


    public function makeDiffResolutions (string $video_filename) {
       
        $ffmpeg = self::createInstanceFFmpeg();

        $resolutions = [
            0 => '320x240',
            1 => '640x480',
            2 => '1280x720',
            3 => '1920x1080',
        ];


        for ($i = 0; $i < count($resolutions); $i++) {
            
            $video = $ffmpeg->open(
                public_path($video_filename)         // opening file from public/videos
            );
            
            switch ($resolutions[$i]) {
                case '320x240':
                    $width = 320;
                    $height = 240;
                    break;
                case '640x480':
                    $width = 640;
                    $height = 480;
                    break;
                case '1280x720':
                    $width = 1280;
                    $height = 720;
                    break; 
                case '1920x1080':
                    $width = 1920;
                    $height = 1080;
                    break;    
            }
            
            $video->filters()
                    ->resize(new \FFMpeg\Coordinate\Dimension($width, $height))  // resizing video to Dimension(320, 240))
                    ->synchronize();
    
            $video_filename = str_replace('videos/', '' , $video_filename); // removing '/public' from filename
    
            $video->save(new \FFMpeg\Format\Video\X264(), $video_filename); // saving resized file into 'public' path
    
            self::moveResizedFileToPath($video_filename, $resolutions[$i]);

            $video_filename = 'videos/' . $video_filename;

        }

        return true;
    }
}