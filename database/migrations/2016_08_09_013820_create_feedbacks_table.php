<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('to_user_id');
            $table->integer('from_user_id');
            $table->integer('quest_id');
            $table->integer('revision');
            $table->integer('subtype');
            $table->text('note');
            $table->integer('likes');
            $table->timestamps();
        });

        Schema::create('feedback_subtypes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('feedbacks');
    }
}
