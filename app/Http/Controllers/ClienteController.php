<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Servico;
use Illuminate\Http\Request;
use Facade\FlareClient\Http\Client;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ClienteController extends Controller
{

    public function create(Request $request)
    {
        return view('importacao.store');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if($data['excel']){
            try {
                //Transformando o xlsx em array
                $spreadsheet = IOFactory::load($data['excel']);

                $worksheet = $spreadsheet->getActiveSheet();
                $rows = [];
                foreach ($worksheet->getRowIterator() AS $row) {
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
                    $cells = [];
                    foreach ($cellIterator as $cell) {
                        $cells[] = $cell->getValue();
                    }
                    $rows[] = $cells;
                }

                //Conferencias para adição no banco
                foreach($rows as $row){
                    if($row[0] == null || $row[0] == 'CNPJ'){
                        continue;
                    }

                    $cnpj = preg_replace('/\D/', '', $row[0]);

                    $servico = Servico::where('id', $row[7])->first();
                    // dd($servico->toArray());
                    if(isset($servico->id)){

                        $getCNPJ = null;


                        $getCNPJ = Cliente::where('cnpj', $cnpj)->first();

                        // dd($getCNPJ->id);
                        // Adicionando Novo Cliente
                        if($getCNPJ == null){
                            $cliente = Cliente::create([
                                'cnpj' => $cnpj,
                                'razao_social' => $row[1],
                                'endereco' => $row[2],
                                'cidade' => $row[3],
                                'uf' => $row[4],
                                'cep' => str_replace('-', '', $row[5])
                            ]);

                        // Atualizando Cliente
                        }else if($getCNPJ['endereco'] != $row[2] || $getCNPJ['cidade'] != $row[3] || $getCNPJ['uf'] != $row[4] || $getCNPJ['cep'] != str_replace('-', '', $row[5])){
                            $cliente = Cliente::where('cnpj', $cnpj)->update([
                                'cnpj' => $cnpj,
                                'endereco' => $row[2],
                                'cidade' => $row[3],
                                'uf' => $row[4],
                                'cep' => str_replace('-', '', $row[5]),
                            ]);
                        }
                        // dd($cliente);

                        //Tratando data
                        $data = ($row[6] - 25569) * 86400;
                        $data = gmdate("Y-m-d", $data);

                        //Inserindo venda
                        $venda = Venda::create([
                            'cliente_id' => isset($cliente->id) ? $cliente->id : $getCNPJ->id,
                            'servico_id' => $row[7],
                            'data_venda' => $data,
                            'horas_trabalhadas' => ($row[10] / $servico->valor_hora),
                            'valor_faturado' => $row[10],
                            'valor_custo' => $row[11],
                            'resultado_venda' => ($row[10] - $row[11])
                        ]);

                    }else{
                        continue;
                    }

                }
            } catch (\Exception $exception) {
                $error = ['code' => 2, 'error_message' => 'Não foi possivel salvar o endereço.'];
            }

            if (!isset($error)) {
                return view('importacao.store');
            }
        }else{
            return view('importacao.store');
        }

    }

    public function show()
    {
        try{
            $addresses = Cliente::all();

            $mounted_addresses = [];
            foreach($addresses as $address){
                array_push($mounted_addresses, array(
                    'id' => $address->id,
                    'public_place' => $address->public_place,
                    'district' => $address->district,
                    'number' => $address->number,
                    'complement' => $address->complement,
                    'zip_code' => $address->zip_code,
                    'city' => $address->city,
                    'state' => $address->state,
                    'reference_point' => $address->reference_point
                ));
            }
        }catch(\Exception $exception){
            $error = ['code' => 2, 'error_message' => 'Não foi possivel listar os endereços.'];
        }

        if (isset($mounted_addresses) && !isset($error)) {
            return $mounted_addresses;
        }

        return $error;
    }

    public function get($id)
    {
        try{
            $address = Cliente::where('id', $id)->first();

            $mounted_address = array(
                'id' => $address->id,
                'public_place' => $address->public_place,
                'district' => $address->district,
                'number' => $address->number,
                'complement' => $address->complement,
                'zip_code' => $address->zip_code,
                'city' => $address->city,
                'state' => $address->state,
                'reference_point' => $address->reference_point
            );
        }catch(\Exception $exception){
            $error = ['code' => 2, 'error_message' => 'Não foi possivel listar o endereço.'];
        }

        if (isset($mounted_address) && !isset($error)) {
            return response()->json(['success' => true, 'data' => $mounted_address, 'error' => $error ?? null]);
        }

        return response()->json(['success' => false, 'data' => null, 'error' => $error ?? null]);
    }

    public function getCNPJ($cnpj)
    {
        try{
            $cliente = Cliente::where('cnpj', $cnpj)->first();

            $mounted_cliente = array(
                'id' => $cliente->id,
                'cnpj' => $cliente->cnpj,
                'razao_social' => $cliente->razao_social,
                'endereco' => $cliente->endereco,
                'cidade' => $cliente->cidade,
                'uf' => $cliente->uf,
                'cep' => $cliente->cep
            );
        }catch(\Exception $exception){
            $error = ['code' => 2, 'error_message' => 'Não foi possivel listar o Cliente.'];
        }

        if (isset($mounted_cliente) && !isset($error)) {
            return $mounted_cliente;
        }

        return $error;
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $user_authenticaded = JWTAuth::toUser();

        try {
            if(isset($data['public_place'])){
                $address['public_place'] = $data['public_place'];
            }
            if(isset($data['district'])){
                $address['district'] = $data['district'];
            }
            if(isset($data['number'])){
                $address['number'] = $data['number'];
            }
            if(isset($data['complement'])){
                $address['complement'] = $data['complement'];
            }
            if(isset($data['zip_code'])){
                $address['zip_code'] = $data['zip_code'];
            }
            if(isset($data['city'])){
                $address['city'] = $data['city'];
            }
            if(isset($data['state'])){
                $address['state'] = $data['state'];
            }
            if(isset($data['reference_point'])){
                $address['reference_point'] = $data['reference_point'];
            }

            $result_address = $user_authenticaded->address()->where('id', $id)->update($address);
        } catch (\Exception $exception) {
            $error = ['code' => 2, 'error_message' => 'Não foi possivel atualizar o endereço.'];
        }

        if (isset($result_address) && !isset($error) && $result_address) {
            return response()->json(['success' => true, 'data' => null, 'error' => $error ?? null]);
        }else{
            $error = ['code' => 2, 'error_message' => 'Não foi possivel atualizar o endereço.'];
        }

        return response()->json(['success' => false, 'data' => null, 'error' => $error ?? null]);
    }
}
