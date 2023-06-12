<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    /**
     * Testing
     */

    public function actualizarClaves()
    {
        $lista = User::all();
        $data = [];

        foreach ($lista as $key) {
            $nuevaClave = $this->decode5t($key->clave);
            $actualizar = User::find($key->id_usuario);
                $actualizar->password = Hash::make($nuevaClave);
            $actualizar->save();
            $data[] = ['nombre' => $key->nombre_corto, 'clave' => $key->clave, 'decode' => $nuevaClave];
        }
        return response()->json($data, 200);
    }

    public function decode5t($str)
    {
        for ($i = 0; $i < 5; $i++) {
            $str = base64_decode(strrev($str));
        }
        return $str;
    }
}
