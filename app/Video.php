<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
	public $timestamps = false;

    /*
	 * Получить категорию
     */ 
	public function category()
	{
		return $this->belongsTo(Category::class); 
	}

}
