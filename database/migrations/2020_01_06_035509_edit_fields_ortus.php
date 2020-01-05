<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditFieldsOrtus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ortus', function (Blueprint $table) {
            $table->dropColumn(['nama_ortu', 'job', 'status']);
            $table->string('nama_ayah', 60);
            $table->string('nama_ibu', 60);
            $table->string('nama_wali', 60)->nullable();
            $table->string('job_ayah', 60);
            $table->string('job_ibu', 60);
            $table->string('job_wali', 60)->nullable();
            $table->string('jl',191);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ortus', function (Blueprint $table) {
            //
            $table->string('nama_ortu');
            $table->string('job');
            $table->string('status');
        });
    }
}
