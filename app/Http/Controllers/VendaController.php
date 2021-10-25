<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function show()
    {
        try{
            $vendas = Venda::all();

            $mounted_vendas = [];
            foreach($vendas as $venda){
                array_push($mounted_vendas, array(
                    'id' => $vendas->id,
                    'descricao' => $vendas->descricao,
                    'valor_hora' => $vendas->valor_hora,
                ));
            }
        }catch(\Exception $exception){
            $error = ['code' => 2, 'error_message' => 'Não foi possivel listar as Vendas.'];
        }

        if (isset($mounted_servicos) && !isset($error)) {
            return view('vendas.show', compact('mounted_servicos'));
        }

        return view('vendas.show', ['error']);
    }
}
