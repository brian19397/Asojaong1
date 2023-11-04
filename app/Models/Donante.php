<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donante extends Model
{
    use HasFactory;

    protected $table = 'donantes';

    protected $primaryKey = 'id_donantes';
}
