<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function show()
    {
        try{
            $servicos = Servico::all();

            $mounted_servicos = [];
            foreach($servicos as $servico){
                array_push($mounted_servicos, array(
                    'id' => $servico->id,
                    'descricao' => $servico->descricao,
                    'valor_hora' => $servico->valor_hora,
                ));
            }
        }catch(\Exception $exception){
            $error = ['code' => 2, 'error_message' => 'Não foi possivel listar os serviços.'];
        }

        if (isset($mounted_servicos) && !isset($error)) {
            return view('servico.show', compact('mounted_servicos'));
        }

        return view('servico.show', ['error']);
    }

    public function get($id)
    {
        try{
            $servicos = Servico::where('id', $id)->first();

            $mounted_servicos = array(
                'id' => $servicos->id,
                'descricao' => $servicos->descricao,
                'valor_hora' => $servicos->valor_hora
            );
        }catch(\Exception $exception){
            $error = ['code' => 2, 'error_message' => 'Não foi possivel listar o serviço.'];
        }

        if (isset($mounted_servicos) && !isset($error)) {
            return view('servico.get', compact('mounted_servicos'));
        }

        return view('servico.get', compact('error'));

    }
}
