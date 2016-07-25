<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
	public $timestamps = false;

    /*
	 * Get category
     */ 
	public function category()
	{
		return $this->belongsTo(Category::class); 
	}

	public static function isExists($url)
	{
		if (Video::where('url', '=', trim($url))->exists()) {
			return true;
		}		
		return false;
	}
}
