<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->string('course');
            $table->integer('mode_of_payment');
            $table->string('reseller_comment')->nullable();
            $table->string('admin_comment')->nullable();
            $table->integer('status')->nullable();
            $table->integer('notification_status_reseller')->nullable();
            $table->integer('notification_status_admin')->nullable();
            $table->integer('candidate_id');
            $table->integer('reseller_id');
            $table->integer('admin_id')->nullable();
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
        Schema::dropIfExists('invoice');
    }
}
