<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUsersLimitAvAddKeywordsLimitAv extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("users", function($table){
			$table->dropColumn("limit_av");
		});

		Schema::table("keywords", function($table){
			$table->integer("limit_av")->default(0);

			$table->index("limit_av");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table("users", function($table){
			$table->integer("limit_av")->default(0);
		});

		Schema::table("keywords", function($table){
			$table->dropColumn("limit_av");
		});
	}

}
