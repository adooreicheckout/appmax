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
			$table->boolean('appmax_enabled')->default(0);
			$table->boolean('appmax_mode')->default(0);
			$table->string('appmax_store_name')->nullable();
			$table->string('appmax_access_token')->nullable();;
			$table->string('appmax_additional_interest_rate')->nullable();
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
