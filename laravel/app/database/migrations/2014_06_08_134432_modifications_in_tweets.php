<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModificationsInTweets extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tweets', function($table){
			$table->bigInteger('user_id')->default(0);
			$table->bigInteger('tweet_id')->default(0);
			$table->integer('followers')->default(0);
			$table->integer('retweets')->default(0);
			$table->integer('favorites')->default(0);
			$table->string('source')->default(0);

			$table->index('user_id');
			$table->index('tweet_id');	
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tweets', function($table){
			$table->dropColumn('user_id', 'tweet_id', 'followers', 'retweets', 'favorites', 'source');
		});
	}

}
