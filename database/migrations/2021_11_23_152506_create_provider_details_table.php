<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->integer('provider_id')->nullable();
            $table->integer('services_id')->nullable();
            $table->integer('provider_type_id')->nullable();
            $table->string('company_name')->nullable();
            $table->string('level')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->time('start_rest_time')->nullable();
            $table->time('end_rest_time')->nullable();
            $table->integer('slot_duration')->default(30);
            $table->integer('status')->default(0);
            $table->string('working_day')->nullable();
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
        Schema::dropIfExists('provider_details');
    }
}
