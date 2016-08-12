<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreCourseInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function ($table) {
            $table->string('meeting_location')->nullable();
            $table->string('office_hours')->nullable();
            $table->string('instructor_display_name')->nullable();
            $table->string('instructor_office_location')->nullable();
            $table->string('instructor_contact')->nullable();
        });
    }
        
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
