<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserSkillAcquisition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skill_user', function ($table) {

            $table->dropForeign('skills_user_id_foreign');
            $table->dropForeign('users_skill_id_foreign');
            $table->integer('quest_id');
            $table->integer('amount');
            $table->primary(['skill_id', 'user_id']);


        });

        Schema::table('user_skill_histories', function ($table) {

            $table->renameColumn('submission_id', 'quest_id');
            $table->integer('revision')->default(0);
        });

        //
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
