<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
			$table->tinyInteger('category_id')->unsigned();
     		$table->string('title', 255);
			$table->string('url', 255);
			$table->string('thumb', 255);
			$table->string('video_file', 255);
			$table->boolean('converted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('videos');
    }
}
