<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableShopAppMax extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if( !Schema::hasTable('shops') )
			throw new Exception('Table "shops" was not found!');
			
		Schema::table('shops', function( Blueprint $table ) {
			$table->string('appmax_enabled');
			$table->string('appmax_mode');
			$table->string('appmax_store_name');
			$table->string('appmax_access_token');
			$table->string('appmax_additional_interest_rate');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		if( Schema::hasTable('shops') ) {
			Schema::table('shops', function (Blueprint $table) {
				$table->dropColumn(
					'appmax_enabled', 
					'appmax_mode',
					'appmax_store_name',
					'appmax_access_token',
					'appmax_additional_interest_rate'
				);
			});
		}
    }
}
