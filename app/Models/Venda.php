<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'servico_id',
        'data_venda',
        'horas_trabalhadas',
        'valor_faturado',
        'valor_custo',
        'resultado_venda'
    ];

    public $timestamps = false;

    protected $table = 'vendas';
}
