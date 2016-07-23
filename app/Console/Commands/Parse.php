<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Parse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse videos from porn.com';

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
		
		$this->parseVideos(['big-tits','russian', 'milf', 'blonde']);
	
    }

	private function parseVideos(array $categories) 
    {

		foreach ($categories as $category) 
		{
			$this->info($category);
		}

		//$title = $this->parseTitle('http://www.porn.com/videos/darla-crane-gets-her-old-wet-cunt-pumped-with-young-cock-1410223');
		$video_stream = $this->parseVideoStream('http://www.porn.com/videos/darla-crane-gets-her-old-wet-cunt-pumped-with-young-cock-1410223');
		$name = $this->uploadVideo($video_stream);
		echo "\n" . "name - " . $name . "\n";
		die("STOP");
		$html = file_get_contents('http://www.porn.com/videos/big-tits');
		$videos = $this->elemOut($html, ".//a[contains(@class,'thumb')]");

		foreach( $videos as $video ) {
			$video_url = "www.porn.com" . $video->getAttribute('href');
			//echo $video_url . "\n";	
			$thumb_img = $video->firstChild->getAttribute('src');
			echo $thumb_img . "\n";
		}
	//	$thumb_saved_name = $this->uploadImage($thumb_img);
		echo "name - ". $thumb_saved_name;
	}

	public function parseVideoStream($video_post_url) 
	{
		$html = file_get_contents($video_post_url);

		$pattern = '(["\']?http?:\/\/[^\/]+(?:\/[^\/]+)*?.mp4\?(&?\w+(=[^&\'"\s]*)?)*)';
		$matches = array();
		$match = preg_match_all($pattern, $html, $matches);

		$video_stream = substr($matches[0][1], 1);

		return $video_stream;
	}

	/*
	 * Parse title of video from video page
	 *  
	 * @param $video_url string URL of video page
	 * 
	 * @return string Return title of video
	 */
	public function parseTitle($video_url)
	{
		$html = file_get_contents($video_url);
		$elements = $this->elemOut($html, ".//h1");
		$title = $elements->item(0)->nodeValue;

		return $title;
	}
	/*
	 * Load HTML into DOMDocument and XPath query
	 *  
	 * @param $html string HTML code for parse
	 * @param $query string XPath query
	 * 
	 * @return DOMNodeList Return query result
	 */
	public function elemOut($html, $query)
	{
		$dom = new \DOMDocument();
		@$dom->loadHTML($html);
	 
		$xpath = new \DOMXpath( $dom );
		return $xpath->query($query);
	}
	
	/*
	 * Upload Image from URL
	 *  
	 * @param $img_path string 
	 * 
	 * @return string Return saved of image name with extension
	 */
	public function uploadImage($img_path) 
	{
		$ext = pathinfo($path);
		$ext = $ext['extension'];
		$img_name = $this->generateRandomString() . '_'. time() . '.' . $ext;
    	copy($img_path, public_path() . '/images/upload_thumbs/'.$img_name);

    	return $img_name;
	}

	/*
	 * Upload Video from URL
	 *  
	 * @param $video_path string 
	 * 
	 * @return string Return saved of video name with extension
	 */
	public function uploadVideo($video_path) 
	{
		
		$video_name = $this->generateRandomString() . '_'. time() . '.mp4';
	
//		$video_stream = fopen('http://im.c33aeb00.273b778.cdn2b.movies.porn.com/1/1410/1410223/LP_240.mp4?s=1469261151&e=1469268351&ri=1266&rs=50&h=8b639ee5386cbabca3cdbbcf087fab42','r');

		echo $video_path . "\n";
		$video_stream = fopen($video_path,'r');

		$video_file = fopen(public_path() . '/upload_videos/mp4/'. $video_name, 'w');
		stream_copy_to_stream($video_stream, $video_file);
		
    	return $video_name;
	}

	/*
	 * Generate Random String
	 *  
	 * @param $length integer Length of string
	 * 
	 * @return string Return random string
	 */
	public function generateRandomString($length = 6) 
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
		    $randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

}
