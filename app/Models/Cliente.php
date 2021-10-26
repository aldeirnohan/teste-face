<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'cnpj',
        'razao_social',
        'endereco',
        'cidade',
        'uf',
        'cep'
    ];

    public $timestamps = false;

    protected $table = 'clientes';

    public function setCnpjAttribute($value)
    {
        $this->attributes['cnpj'] = preg_replace('/\D/', '', $value);
    }

}
