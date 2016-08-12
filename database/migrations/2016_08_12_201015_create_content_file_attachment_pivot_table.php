<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentFile_attachmentPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_file_attachment', function (Blueprint $table) {
            $table->integer('content_id')->unsigned()->index();
            $table->foreign('content_id')->references('id')->on('contents')->onDelete('cascade');
            $table->integer('file_attachment_id')->unsigned()->index();
            $table->foreign('file_attachment_id')->references('id')->on('file_attachments')->onDelete('cascade');
            $table->primary(['content_id', 'file_attachment_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('content_file_attachment');
    }
}
