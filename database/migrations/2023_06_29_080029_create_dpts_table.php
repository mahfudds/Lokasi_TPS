<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateDptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dpts', function (Blueprint $table) {
            $table->id();
			$table->integer('ID');
			$table->string('Kecamatan');
			$table->string('Kelurahan');
			$table->string('Kode_kelurahan');
			$table->string('No_TPS');
			$table->string('Latitude');
			$table->string('Longitude');
			$table->integer('Jumlah_pemilih');
			$table->integer('validasi');
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
        Schema::dropIfExists('dpts');
    }
}
