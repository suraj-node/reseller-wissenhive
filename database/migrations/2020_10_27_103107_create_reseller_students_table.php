<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResellerStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reseller_students', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('fname');
            $table->string('lname');
            $table->string('mobile');
            $table->string('country');
            $table->integer('status');
            $table->integer('added_by')->comment('0->verified, 1->unverifed');
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
        Schema::dropIfExists('reseller_students');
    }
}
