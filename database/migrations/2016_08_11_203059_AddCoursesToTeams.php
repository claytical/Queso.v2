<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoursesToTeams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('team_user', function ($table) {
            $table->dropForeign('team_user_team_id_foreign');
            $table->dropForeign('team_user_user_id_foreign');
            $table->dropPrimary('user_id');
            $table->dropPrimary('team_id');
            $table->integer('course_id')->unsigned()->index();
            $table->primary(['course_id', 'user_id', 'team_id']);

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
