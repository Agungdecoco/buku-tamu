<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->char('nip')->primary();
            // $table->foreignId('users_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->char('users_id');
            $table->string('nama_tamu');
            $table->char('tlp_tamu')->nullable();
            // $table->string('email_tamu');
            $table->string('jabatan_tamu')->nullable();
            $table->string('instansi')->nullable();
            // $table->string('status');
            // $table->string('password');
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('guests');
    }
}
