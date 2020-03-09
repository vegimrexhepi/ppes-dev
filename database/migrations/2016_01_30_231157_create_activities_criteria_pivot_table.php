<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesCriteriaPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities_criteria', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('activity_id')->unsigned();
            $table->integer('criterion_id')->unsigned();
            // add foreign keys
            $table->foreign('activity_id')->references('id')->on('activities')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('criterion_id')->references('id')->on('criteria')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activities_criteria');
    }
}
