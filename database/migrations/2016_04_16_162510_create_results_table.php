<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('voting_user_id')->index()->nullable();
            $table->unsignedInteger('activity_id')->index()->nullable();
            $table->unsignedInteger('student_evaluated_id')->index()->nullable();
            $table->unsignedInteger('criterion_id')->index()->nullable();
            $table->unsignedInteger('vote_value')->nullable();
            $table->timestamps();

            // Define foreign keys
            $table->foreign('activity_id')->references('id')->on('activities')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('voting_user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('student_evaluated_id')->references('id')->on('users')
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
        Schema::drop('results');
    }
}
