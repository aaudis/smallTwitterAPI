<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tweets extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("tweets", function($table){
			$table->increments("id");
			$table->string("imei_code");
			$table->string("keywords");
			$table->string("screen_name");
			$table->string("full_name");
			$table->dateTime("date");
			$table->string("tweet");
			$table->string("url_to_tweet");
			$table->string("profile_img");

			$table->index("imei_code");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("tweets");
	}

}
