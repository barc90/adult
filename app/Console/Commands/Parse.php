<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Video;
use App\Category;

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
	 * Video post urls 
	 *
	 * @var array
	 */
	protected $video_urls = [];

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
		$count_videos = Video::count();
		 	
		$categories = Category::all();

		foreach ($categories as $category) {
			$vid_info_all_items[] = $this->parseVideos($category->slug, $category->id);
		}

		foreach ($vid_info_all_items as $vid_info_items) {
			foreach ($vid_info_items as $vid_info_item) {
	
				$video_stream_url = $this->parseVideoStream('http://' .$vid_info_item['url']);

				$video = new Video;
				$video->category_id = $vid_info_item['category_id'];
				$video->title = $this->parseTitle('http://' .$vid_info_item['url']);
				$video->url = $vid_info_item['url'];
				$video->thumb = $this->uploadImage($vid_info_item['thumb']);				
				$video->video_file = $this->uploadVideo($video_stream_url);
				$video->save();
			}
					
		}

		$added_videos = Video::count() - $count_videos;
		$this->info("Added $added_videos videos");
		
    }

	/*
	 * Parse video urls and thumbnails
	 *  
	 * @param $category_slug string Category slug
	 *  
	 * @param $category_id integer Category id
	 *	
	 * @return array Return array of videos and thumbnails
	 */
	public function parseVideos($category_slug, $category_id)
	{
		$count_videos = 5;
		$is_have_next = true;
		$tmp_urls_previous = '';

		for ($i = 1; $count_videos != 0; $i++) { // $is_have_next &&
			$tmp_urls_current = '';
			$html_page = @file_get_contents("http://www.porn.com/videos/$category_slug?p=" . $i);
	
			$video_post_urls = $this->elemOut($html_page, ".//a[contains(@class,'thumb')]");

			foreach( $video_post_urls as $url ) {
				$video_url = 'porn.com' . $url->getAttribute('href');
				if (!Video::isExists($video_url) && !in_array($video_url, $this->video_urls) && $count_videos != 0) {
					$thumb_img = $url->firstChild->getAttribute('src');
					$tmp_urls[] = ["url" => $video_url, "thumb" => $thumb_img, "category_id" => $category_id]; 	
					$this->video_urls[] = $video_url;
					$count_videos--;
				}	
							
				$tmp_urls_current .= $video_url;
			}

			if ($tmp_urls_current == $tmp_urls_previous)
				break;

			$tmp_urls_previous = $tmp_urls_current;
			sleep(1);
		}

		return $tmp_urls;

	}

	/*
	 * Parse video sream from video page
	 *  
	 * @param $video_post_url string URL of video post
	 * 
	 * @return string Return video stream url
	 */
	public function parseVideoStream($video_post_url) 
	{
		$html = file_get_contents($video_post_url);

		$pattern = '(["\']?http?:\/\/[^\/]+(?:\/[^\/]+)*?.mp4\?(&?\w+(=[^&\'"\s]*)?)*)';
		$matches = array();
		$match = preg_match_all($pattern, $html, $matches);

		$video_stream = substr($matches[0][0], 1);

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
		$ext = pathinfo($img_path);
		$ext = $ext['extension'];
		$img_name = $this->generateRandomString() . '_'. time() . '.' . $ext;
    	copy($img_path, public_path() . '/images/upload_thumbs/'.$img_name);

    	return $img_name;
	}

	/*
	 * Upload Video from stream URL
	 *  
	 * @param $video_stream_url string Video stream URL
	 * 
	 * @return string Return saved of video name with extension
	 */
	public function uploadVideo($video_stream_url) 
	{		
		$video_name = $this->generateRandomString() . '_'. time() . '.mp4';
		$video_stream = fopen($video_stream_url,'r');

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
