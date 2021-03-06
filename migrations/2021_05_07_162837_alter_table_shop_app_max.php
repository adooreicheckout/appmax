<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableShopAppMax extends Migration
{
    public function up()
    {
		if( Schema::hasTable('shops') ) {
			Schema::table('shops', function( Blueprint $table ) {
				$table->boolean('appmax_enabled')->default(0);
				$table->boolean('appmax_mode')->default(0);
				$table->string('appmax_store_name')->nullable();
				$table->string('appmax_access_token')->nullable();
				$table->boolean('appmax_boleto_enabled')->nullable();
				$table->boolean('appmax_card_enabled')->nullable();
				$table->string('appmax_additional_interest_rate')->nullable();
			});
		}
    }

    public function down()
    {
		if( Schema::hasTable('shops') ) {
			Schema::table('shops', function (Blueprint $table) {
				$table->dropColumn(
					'appmax_enabled',
					'appmax_mode',
					'appmax_store_name',
					'appmax_access_token',
					'appmax_additional_interest_rate',
					'appmax_boleto_enabled',
					'appmax_card_enabled'
				);
			});
		}
    }
}
