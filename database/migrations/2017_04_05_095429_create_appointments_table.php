<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->integer('calendar_id')->unsigned();
            $table->integer('appointment_type_id')->unsigned()->nullable();
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->string('title');
            $table->string('location')->nullable();
            $table->timestamps();
            $table->foreign('calendar_id')->references('id')->on('calendars')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('appointment_type_id')->references('id')->on('appointment_types')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
