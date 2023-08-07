<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateConsultantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultants', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->char('nip');
            $table->string('nama_konsultan');
            $table->char('tlp_konsultan');
            $table->string('email_konsultan');
            $table->string('jabatan_konsultan');
            $table->boolean('isActive')->default(false);
            $table->timestamps();
            $table->primary('nip');
        });

        DB::table('consultants')->insert([
            'nip' => '123456789',
            'nama_konsultan' => 'Pak Harun',
            'tlp_konsultan' => '08912345678',
            'email_konsultan' => 'harun@gmail.com',
            'jabatan_konsultan' => 'konsultan data dan statistik',
            'isActive' => false
        ]);

        DB::table('consultants')->insert([
            'nip' => '1111111111',
            'nama_konsultan' => 'Pak Yudis',
            'tlp_konsultan' => '08912345678',
            'email_konsultan' => 'yudis@gmail.com',
            'jabatan_konsultan' => 'konsultan data dan statistik',
            'isActive' => false
        ]);

        DB::table('consultants')->insert([
            'nip' => '2222222222',
            'nama_konsultan' => 'Bu Iffa',
            'tlp_konsultan' => '08912345678',
            'email_konsultan' => 'iffa@gmail.com',
            'jabatan_konsultan' => 'konsultan data dan statistik',
            'isActive' => false
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultants');
    }
}
