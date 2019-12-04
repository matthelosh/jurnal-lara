<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogAbsensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_absens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_absen');
            $table->string('hari');
            $table->string('guru_id');
            $table->string('mapel_id');
            $table->string('rombel_id');
            $table->string('jamke');
            $table->string('jml_siswa')->default(0);
            $table->string('hadir');
            $table->string('ijin');
            $table->string('sakit');
            $table->string('alpa');
            $table->string('telat');
            $table->string('ket');
            $table->boolean('isActive')->default(false);
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
        Schema::dropIfExists('log_absens');
    }
}
