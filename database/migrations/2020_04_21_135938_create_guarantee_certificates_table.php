<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuaranteeCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guarantee_certificates', function (Blueprint $table) {
            $table->id();
            $table->text('id_guarantee');
            $table->string('unit_tooth')->nullable();
            $table->foreignId('information_id')->nullable();
            $table->foreignId('doctor_id')->nullable();
            $table->foreignId('service_id')->nullable();
            $table->text('image_before')->nullable();
            $table->text('image_doing')->nullable();
            $table->text('image_finish')->nullable();
            $table->string('date_guarantee');
            $table->string('date_finish')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('information_id')->references('id')->on('informations');
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guarantee_certificates');
    }
}
