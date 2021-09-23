<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableAppMaxAddPix extends Migration
{
    public function up()
    {
        if( Schema::hasTable('shops') ) {
			Schema::table('shops', function( Blueprint $table ) {
				$table->boolean('appmax_pix_enabled')->nullable();
			});
		}
    }

    public function down()
    {
        if( Schema::hasTable('shops') ) {
			Schema::table('shops', function (Blueprint $table) {
				$table->dropColumn(
					'appmax_pix_enabled',
				);
			});
		}
    }
}
