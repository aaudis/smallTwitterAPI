<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropImeiCodeIndexFromTweetsAndAddMultiIndexImeiCodeKeywords extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tweets', function($table){
			$table->dropIndex('tweets_imei_code_index');

			$table->index(array('imei_code', 'keywords'));
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
			$table->dropIndex('tweets_imei_code_keywords_index');
			
			$table->index('imei_code');		
		});
	}

}
