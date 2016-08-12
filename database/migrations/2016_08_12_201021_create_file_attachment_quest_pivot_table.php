<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileAttachmentQuestPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_attachment_quest', function (Blueprint $table) {
            $table->integer('file_attachment_id')->unsigned()->index();
            $table->foreign('file_attachment_id')->references('id')->on('file_attachments')->onDelete('cascade');
            $table->integer('quest_id')->unsigned()->index();
            $table->foreign('quest_id')->references('id')->on('quests')->onDelete('cascade');
            $table->primary(['file_attachment_id', 'quest_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('file_attachment_quest');
    }
}
