<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateQuestUserTimestamps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quest_user', function ($table) {

            $table->dropForeign('quest_user_quest_id_foreign');
            $table->dropForeign('quest_user_user_id_foreign');
/*            $table->integer('revision')->default(0);
            $table->boolean('graded');
            $table->timestamps();
            $table->dropPrimary('quest_id');
            $table->dropPrimary('user_id');
            $table->primary(['revision', 'user_id', 'quest_id']);
*/

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
