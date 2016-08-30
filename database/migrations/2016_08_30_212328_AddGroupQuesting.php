<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGroupQuesting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quests', function ($table) {
            $table->boolean('groups')->default(0);

        });


        Schema::create('group_quest', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quest_id');
            $table->integer('attempt_id');
            $table->timestamps();
        });

        Schema::create('group_quest_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_quest_id');
            $table->integer('user_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
