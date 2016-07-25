<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Video;

class Encode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'encode';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Conversion videos from MP4 to FLV';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
		$videos = Video::where('converted', 0)->get();	
		
		foreach ($videos as $video) {

			$current_file_name = public_path() . '/upload_videos/mp4/' . $video->video_file;
			$new_file_name     = public_path() . '/upload_videos/flv/' . substr($video->video_file, 0, -4) . '.flv';
			$out .= shell_exec("ffmpeg -y -i $current_file_name -c:v libx264 -crf 19 -strict experimental $new_file_name");
		
			$video->converted = 1;
			$video->save();			
		}

    	$this->info("Convering is completed!");
    }
}
