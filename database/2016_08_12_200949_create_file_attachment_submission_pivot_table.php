<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFile_attachmentSubmissionPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_attachment_submission', function (Blueprint $table) {
            $table->integer('file_attachment_id')->unsigned()->index();
            $table->foreign('file_attachment_id')->references('id')->on('file_attachments')->onDelete('cascade');
            $table->integer('submission_id')->unsigned()->index();
            $table->foreign('submission_id')->references('id')->on('submissions')->onDelete('cascade');
            $table->primary(['file_attachment_id', 'submission_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('file_attachment_submission');
    }
}
