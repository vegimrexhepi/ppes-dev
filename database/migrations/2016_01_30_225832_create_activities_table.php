<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('user_id')->unsigned();
            $table->string('title')->unique();;
            $table->double('bonus1', 6, 3)->default(0);
            $table->double('bonus2', 6, 3)->default(0);
            $table->string('invitation_link')->nullable();
            $table->string('enrollment_key')->nullable();
            $table->string('access_code')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();

            // Add foreign keys
            /*$table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activities');
    }
}
