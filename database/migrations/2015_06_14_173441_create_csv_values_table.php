<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCsvValuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('csv_values', function(Blueprint $table)
		{
			$table->increments('id');
            $table->text('industry_name');
            $table->text('industry_description');
            $table->text('industry_tag')->nullable();
            $table->text('trade_name');
            $table->text('trade_description');
            $table->text('trade_tag')->nullable();
            $table->text('process_name');
            $table->text('process_description');
            $table->text('process_tag')->nullable();
            $table->text('work_activity_name');
            $table->text('work_activity_description');
            $table->text('work_activity_tag')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('csv_values');
	}

}
