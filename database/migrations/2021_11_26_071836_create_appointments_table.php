<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->integer('user_id');
            $table->integer('provider_id');
            $table->integer('providerDetails_id');
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->integer('duration')->nullable();
            $table->integer('status')->default(0);
            $table->string('remarks')->nullable();
            $table->string('remark_approval')->nullable();
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
        Schema::dropIfExists('appointments');
    }
}
