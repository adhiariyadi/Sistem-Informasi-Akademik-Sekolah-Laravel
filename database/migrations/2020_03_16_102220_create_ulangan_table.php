<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUlanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ulangan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('siswa_id');
            $table->integer('kelas_id');
            $table->integer('guru_id');
            $table->integer('mapel_id');
            $table->string('ulha_1', 5)->nullable();
            $table->string('ulha_2', 5)->nullable();
            $table->string('uts', 5)->nullable();
            $table->string('ulha_3', 5)->nullable();
            $table->string('uas', 5)->nullable();
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
        Schema::dropIfExists('ulangan');
    }
}
