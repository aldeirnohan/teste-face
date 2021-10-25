<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'endereco',
        'numero',
        'cidade',
        'UF',
        'CEP'
    ];

    protected $table = 'enderecos';


}
