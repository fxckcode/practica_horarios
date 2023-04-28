<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambientes extends Model
{
    use HasFactory;
    protected $table = 'ambientes';
    protected $primaryKey = 'id_ambiente';
    protected $fillable = [
        'id_ambiente',
        'nombre_amb',
        'fk_municipio',
        'sede',
        'estado'
    ];
}
