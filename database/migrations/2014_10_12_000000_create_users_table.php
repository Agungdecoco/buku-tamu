<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('status');
            $table->rememberToken();
            $table->timestamps();
        });

        $password_consultant = Hash::make('consultant123');
        DB::table('users')->insert([
            'email' => 'consultant@gmail.com',
            'password' => $password_consultant,
            'status' => 'consultant',
        ]);

        $password_admin = Hash::make('admin123');
        DB::table('users')->insert([
            'email' => 'admin@gmail.com',
            'password' => $password_admin,
            'status' => 'admin',
        ]);

        $password_guest = Hash::make('tamu123');
        DB::table('users')->insert([
            'email' => 'test@gmail.com',
            'password' => $password_guest,
            'status' => 'VIP || NONVIP',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
