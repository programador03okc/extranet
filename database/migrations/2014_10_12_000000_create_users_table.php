<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('correo')->unique();                 // programador2@okcomputer.com.pe
            $table->string('password');                         // inicio01
            $table->string('nombre_largo');                     // Edgar Alvarez Valdez
            $table->string('nombre_corto');                     // Edgar Alvarez
            $table->string('telefono')->nullable();             // Telefono para notificaciones CEL|WTSP
            $table->boolean('flag_aprobador')->default(false);  // Flag para saber si el usuario aprueba los permisos
            $table->rememberToken();
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
        Schema::dropIfExists('usuarios');
    }
}
