<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Venda;
use Illuminate\Http\Request;
use App\Models\Servico;

class VendaController extends Controller
{
    public function show()
    {
        try{
            $vendas = Venda::with(['servico', 'cliente'])->get();

            $mounted_vendas = [];
            foreach($vendas as $venda){
                // $cliente = Cliente::where('id', $venda->cliente_id)->get();

                // $servico = Servico::where('id', $venda->servico_id)->get();

                array_push($mounted_vendas, array(
                    'id' => $venda->id,
                    'cliente' => $venda->cliente->razao_social ?? 'não há',
                    'servico' => $venda->servico->descricao ?? 'não há',
                    'data_venda' => $venda->data_venda,
                    'horas_trabalhadas' => $venda->horas_trabalhadas,
                    'valor_faturado' => $venda->valor_faturado,
                    'valor_custo' => $venda->valor_custo,
                    'resultado_venda' => $venda->resultado_venda
                ));
            }
        }catch(\Exception $exception){
            $error = ['code' => 2, 'error_message' => 'Não foi possivel listar as Vendas.'];
        }

        if (isset($mounted_vendas) && !isset($error)) {
            return view('venda.show', compact('mounted_vendas'));
        }

        return view('venda.show', ['error']);
    }

    public function cliente()
    {
        try{
            $clientes = Cliente::get();
            // dd($clientes);
            $mounted_clientes = [];
            foreach($clientes as $cliente){
                array_push($mounted_clientes, array(
                    'id' => $cliente->id,
                    'cnpj' => $cliente->cnpj,
                    'razao_social' => $cliente->razao_social,
                ));
            }
        }catch(\Exception $exception){
            $error = ['code' => 2, 'error_message' => 'Não foi possivel listar as Vendas.'];
        }

        if (isset($mounted_clientes) && !isset($error)) {
            return view('indicadores.cliente', compact('mounted_clientes'));
        }

        return view('indicadores.cliente', ['error']);
    }

    public function buscaCliente(Request $request)
    {
        $cliente_id = $request->input('cliente_id');

        try{
            $clientes = Cliente::get();
            // dd($clientes->toArray());
            $mounted_clientes = [];
            foreach($clientes as $cliente){
                array_push($mounted_clientes, array(
                    'id' => $cliente->id,
                    'cnpj' => $cliente->cnpj,
                    'razao_social' => $cliente->razao_social
                ));
            }

            $clientes_buscas = Venda::with('cliente')->where('cliente_id', $cliente_id)->get();
            // dd($clientes_buscas->toArray());
            $mounted_clientes_busca = [
                'razao_social' => $clientes_buscas[0]->cliente->razao_social,
                'total_horas' => 0,
                'total_vendas' => 0,
                'total_custo' => 0,
                'resultado' => 0,
            ];
            foreach($clientes_buscas as $clientes_busca){
                $mounted_clientes_busca['total_horas'] += $clientes_busca->horas_trabalhadas;
                $mounted_clientes_busca['total_vendas'] += $clientes_busca->valor_faturado;
                $mounted_clientes_busca['total_custo'] += $clientes_busca->valor_custo;
                $mounted_clientes_busca['resultado'] += $clientes_busca->resultado_venda;
            }
            // dd($mounted_clientes_busca);
        }catch(\Exception $exception){
            $error = ['code' => 2, 'error_message' => 'Não foi possivel listar as Vendas.'];
        }

        if (isset($mounted_clientes) && isset($mounted_clientes_busca) && !isset($error)) {
            return view('indicadores.cliente', compact('mounted_clientes', 'cliente_id', 'mounted_clientes_busca'));
        }

        return view('indicadores.cliente', ['error']);
    }

    public function servico()
    {
        try{
            $servicos = Servico::get();
            // dd($clientes);
            $mounted_servicos = [];
            foreach($servicos as $servico){
                array_push($mounted_servicos, array(
                    'id' => $servico->id,
                    'descricao' => $servico->descricao,
                    'valor_hora' => $servico->valor_hora,
                ));
            }
        }catch(\Exception $exception){
            $error = ['code' => 2, 'error_message' => 'Não foi possivel listar as Vendas.'];
        }

        if (isset($mounted_servicos) && !isset($error)) {
            return view('indicadores.servico', compact('mounted_servicos'));
        }

        return view('indicadores.servico', ['error']);
    }

    public function buscaServico(Request $request)
    {
        $servico_id = $request->input('servico_id');

        try{
            $servicos = Servico::get();
            // dd($clientes->toArray());
            $mounted_servicos = [];
            foreach($servicos as $servico){
                array_push($mounted_servicos, array(
                    'id' => $servico->id,
                    'descricao' => $servico->descricao,
                    'valor_hora' => $servico->valor_hora
                ));
            }

            $servicos_buscas = Venda::with('servico')->where('servico_id', $servico_id)->get();
            // dd($clientes_buscas->toArray());
            $mounted_servicos_busca = [
                'descricao' => $servicos_buscas[0]->servico->descricao,
                'total_horas' => 0,
                'total_vendas' => 0,
                'total_custo' => 0,
                'resultado' => 0,
            ];
            foreach($servicos_buscas as $servicos_busca){
                $mounted_servicos_busca['total_horas'] += $servicos_busca->horas_trabalhadas;
                $mounted_servicos_busca['total_vendas'] += $servicos_busca->valor_faturado;
                $mounted_servicos_busca['total_custo'] += $servicos_busca->valor_custo;
                $mounted_servicos_busca['resultado'] += $servicos_busca->resultado_venda;
            }
            // dd($mounted_clientes_busca);
        }catch(\Exception $exception){
            $error = ['code' => 2, 'error_message' => 'Não foi possivel listar as Vendas.'];
        }

        if (isset($mounted_servicos) && isset($mounted_servicos_busca) && !isset($error)) {
            return view('indicadores.servico', compact('mounted_servicos', 'servico_id', 'mounted_servicos_busca'));
        }

        return view('indicadores.servico', ['error']);
    }

    public function mes()
    {
        return view('indicadores.mes');
    }

    public function buscaMes(Request $request)
    {
        $mes = request()->input('mes');

        try{
            $primeiro = now()->create(date('Y'), $mes)->format('Y-m-d');

            $ultimo =  now()->create(date('Y'), $mes)->lastOfMonth()->format('Y-m-d');
            // dd($primeiro, $ultimo);

            $meses_buscas = Venda::where('data_venda', '>=', $primeiro)->where('data_venda', '<=', $ultimo)->get();
            // dd($meses_buscas->toArray());
            $mounted_mes_busca = [
                'mes' => $mes,
                'total_horas' => 0,
                'total_vendas' => 0,
                'total_custo' => 0,
                'resultado' => 0,
            ];
            foreach($meses_buscas as $mes_buscas){
                $mounted_mes_busca['total_horas'] += $mes_buscas->horas_trabalhadas;
                $mounted_mes_busca['total_vendas'] += $mes_buscas->valor_faturado;
                $mounted_mes_busca['total_custo'] += $mes_buscas->valor_custo;
                $mounted_mes_busca['resultado'] += $mes_buscas->resultado_venda;
            }
            // dd($mounted_clientes_busca);
        }catch(\Exception $exception){
            $error = ['code' => 2, 'error_message' => 'Não foi possivel listar as Vendas.'];
        }

        if (isset($mounted_mes_busca) && !isset($error)) {
            return view('indicadores.mes', compact('mounted_mes_busca', 'mes'));
        }

        return view('indicadores.mes', ['error']);
    }
}
