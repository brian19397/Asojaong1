<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'rol';

    protected $primaryKey = 'idRol';

    public static function rols(){

        $rol = Rol::join('users', 'users.idRol', 'rol.idRol')
        ->select('rol.*')
        ->where('users.id', auth::user()->id)
        ->first();

        return $rol->nombre;
    }
}
