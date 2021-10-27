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

    public function servico(){
        return $this->belongsTo(Servico::class, 'servico_id');
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    protected $table = 'vendas';
}
