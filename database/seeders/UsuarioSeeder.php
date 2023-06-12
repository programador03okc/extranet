<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'correo'            => 'programador2@okcomputer.com.pe',
            'password'          => Hash::make('Inicio01'),
            'nombre_largo'      => 'Edgar Alvarez Valdez',
            'nombre_corto'      => 'Edgar Alvarez',
            'flag_aprobador'    => true,
            'remember_token'    => Str::random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ]);
    }
}
