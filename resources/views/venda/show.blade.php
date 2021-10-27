<!DOCTYPE html>
<html>
    <head>
        <title>Vendas Realizadas</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    </head>
    <body>
        <div class="container">
            <h3 class="section-title" align="center">Vendas Realizadas</h3>
            <div class="container">
                <a class="btn btn-primary" align="center" href="{{ route('index') }}"><i class="fas fa-arrow-circle-left icon"></i> Voltar</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th scope="col">Data</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Serviço Vendido</th>
                        <th scope="col">Horas Consumidas</ht>
                        <th scope="col">Valor da venda</th>
                        <th scope="col">Custo da venda</th>
                        <th scope="col">Resultado da venda</th>
                    </tr>
                    @foreach($mounted_vendas as $venda)
                        <tr>
                            <td>{{$venda['data_venda']}}</td>
                            <td>{{$venda['cliente']}}</td>
                            <td>{{$venda['servico']}}</td>
                            <td>{{$venda['horas_trabalhadas']}}</td>
                            <td>{{$venda['valor_faturado']}}</td>
                            <td>{{$venda['valor_custo']}}</td>
                            <td>{{$venda['resultado_venda']}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </body>
</html>

<style>
    body {
        background: #ededed;
    }

    .icon {
        font-size: 18px;
        margin-right: 8px;
    }

    .my-container {
        margin: 20px 50px;
        display: flex;
        justify-content: space-between;
    }
    .section-title {
        color: lightslategray;
        font-size: 22px;
        font-weight: bold;
    }

    .center-container {
        min-height: calc(100vh - 117px);
        background: #ededed;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .center-title {
        font-size: 7rem;
        color: grey;
    }
    .center-subtitle {
        font-size: 2rem;
        color: grey;
        text-align: center;
    }
</style>
