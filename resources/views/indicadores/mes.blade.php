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

                <form method="post" enctype="multipart/form-data" action="{{ route('indicadores.buscaMes') }}">
                    @csrf
                    <select class="select2" name="mes">
                        <option selected>SELECIONE</option>
                        <option @isset($mes) @if($mes == '01') selected @endif @endisset value="01">JANEIRO</option>
                        <option @isset($mes) @if($mes == '02') selected @endif @endisset value="02">FEVEREIRO</option>
                        <option @isset($mes) @if($mes == '03') selected @endif @endisset value="03">MARÇO</option>
                        <option @isset($mes) @if($mes == '04') selected @endif @endisset value="04">ABRIL</option>
                        <option @isset($mes) @if($mes == '05') selected @endif @endisset value="05">MAIO</option>
                        <option @isset($mes) @if($mes == '06') selected @endif @endisset value="06">JUNHO</option>
                        <option @isset($mes) @if($mes == '07') selected @endif @endisset value="07">JULHO</option>
                        <option @isset($mes) @if($mes == '08') selected @endif @endisset value="08">AGOSTO</option>
                        <option @isset($mes) @if($mes == '09') selected @endif @endisset value="09">SETEMBRO</option>
                        <option @isset($mes) @if($mes == '10') selected @endif @endisset value="10">OUTUBRO</option>
                        <option @isset($mes) @if($mes == '11') selected @endif @endisset value="11">NOVEMBRO</option>
                        <option @isset($mes) @if($mes == '12') selected @endif @endisset value="12">DEZEMBRO</option>

                    </select>
                    <input type="submit" class="btn btn-primary" /></td>
                    <a class="btn btn-primary" align="center" href="{{ route('index') }}"><i class="fas fa-arrow-circle-left icon"></i> Voltar</a>
                </form>

            </div>

            <div class="table-responsive">
                <span id="message"></span>

                <br />
                @isset($mounted_mes_busca)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th scope="col">Mes</th>
                            <th scope="col">Total de horas</th>
                            <th scope="col">Valor total de vendas</th>
                            <th scope="col">Custo total</ht>
                            <th scope="col">Resultado</th>
                        </tr>
                        <tr>
                            <td>{{$mounted_mes_busca['mes']}}</td>
                            <td>{{$mounted_mes_busca['total_horas']}}</td>
                            <td>{{$mounted_mes_busca['total_vendas']}}</td>
                            <td>{{$mounted_mes_busca['total_custo']}}</td>
                            <td>{{$mounted_mes_busca['resultado']}}</td>
                        </tr>
                    </table>
                </div>
                @else
                    <h3 align="center">Busque por algum mes!</h3>
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

