<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResellersEnrollStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resellers_enroll_students', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('course_id');
            $table->integer('schedule_id')->comment('0-> Group, 1->One on one, 2-> Interview Prepration, 3->Project Support');
            $table->string('currency');
            $table->integer('amount');
            $table->integer('amount_status')->comment('0->Paid, 1->Not Paid');
            $table->integer('assign_by');
            $table->integer('notify_admin')->default(0);
            $table->integer('notify_reseller')->default(0);
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
        Schema::dropIfExists('resellers_enroll_students');
    }
}
