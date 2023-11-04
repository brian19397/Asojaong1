<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignarBeneficiado extends Model
{
    use HasFactory;

    protected $table = 'asignacion_beneficiarios';

    protected $primaryKey = 'idAsginacion';
}
