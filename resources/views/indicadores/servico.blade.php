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
            <br />
            <h2 align="center">Vendas Realizadas</h2>
            <br />

            <div class="container">

                <form method="post" enctype="multipart/form-data" action="{{ route('indicadores.buscaServico') }}">
                    @csrf
                    <select class="select2" name="servico_id">
                        <option selected>SELECIONE</option>
                        @isset($mounted_servicos)
                        @foreach ($mounted_servicos as $servico)
                            <option @isset($servico_id) @if($servico_id == $servico['id']) selected @endif @endisset value="{{$servico['id']}}">{{$servico['descricao']}}</option>
                        @endforeach
                        @endisset
                    </select>
                    <input type="submit" class="btn btn-primary" /></td>
                    <a class="btn btn-primary" align="center" href="{{ route('index') }}"><i class="fas fa-arrow-circle-left icon"></i> Voltar</a>
                </form>

            </div>

            <div class="table-responsive">
                <span id="message"></span>

                <br />
                @isset($mounted_servicos_busca)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th scope="col">Descrição do servico</th>
                            <th scope="col">Total de horas</th>
                            <th scope="col">Valor total de vendas</th>
                            <th scope="col">Custo total</ht>
                            <th scope="col">Resultado</th>
                        </tr>
                        <tr>
                            <td>{{$mounted_servicos_busca['descricao']}}</td>
                            <td>{{$mounted_servicos_busca['total_horas']}}</td>
                            <td>{{$mounted_servicos_busca['total_vendas']}}</td>
                            <td>{{$mounted_servicos_busca['total_custo']}}</td>
                            <td>{{$mounted_servicos_busca['resultado']}}</td>
                        </tr>
                    </table>
                </div>
                @else
                    <h3 align="center">Busque por algum Serviço!</h3>
                @endisset
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
