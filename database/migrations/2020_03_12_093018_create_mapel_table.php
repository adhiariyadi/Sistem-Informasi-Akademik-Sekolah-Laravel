<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_mapel', 50);
            $table->integer('paket_id');
            $table->enum('kelompok', ['A', 'B', 'C']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mapel');
    }
}
