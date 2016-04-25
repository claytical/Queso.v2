<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('instructions');
            $table->integer('quest_type_id');
            $table->integer('course_id');
            $table->dateTime('expires_at')->nullable();
            $table->string('category')->nullable();
            $table->string('color')->nullable();
            $table->boolean('uploads');
            $table->boolean('revisions');
            $table->boolean('submissions');
            $table->boolean('peer_feedback');
            $table->boolean('instant');
            $table->string('youtube_id')->nullable();
            $table->boolean('visible');
            $table->softDeletes();
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
        Schema::drop('quests');
    }
}
