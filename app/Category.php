<?php

namespace App;

use App\Video;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'categories';
    public $timestamps = false;

	/*
	 * Получить видео
     */ 
	public function videos()
	{
		return $this->hasMany(Video::class); 
	}

}
