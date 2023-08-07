<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->date('tgl_konsultasi');
            $table->string('sesi');
            $table->char('consultants_nip');
            $table->foreign('consultants_nip')->references('nip')->on('consultants');
            $table->char('guests_nip');
            $table->foreign('guests_nip')->references('nip')->on('guests');
            $table->text('topik');
            $table->string('tipe_konsultasi');
            $table->string('ruang');
            $table->string('anggota1')->nullable();
            $table->string('anggota2')->nullable();
            $table->string('anggota3')->nullable();
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
        Schema::dropIfExists('histories');
    }
}
