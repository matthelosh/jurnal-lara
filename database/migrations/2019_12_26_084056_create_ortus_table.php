<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrtusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ortus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nik_aktif')->unique();
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('nama_wali');
            $table->string('job_ayah');
            $table->string('job_ibu');
            $table->string('job_wali');
            $table->string('hp_ayah');
            $table->string('hp_ibu');
            $table->string('hp_wali');
            $table->string('alamat_ayah');
            $table->string('alamat_ibu');
            $table->string('alamat_wali');
            $table->string('email_aktif');
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
        Schema::dropIfExists('ortus');
    }
}
