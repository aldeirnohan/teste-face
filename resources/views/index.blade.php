<!DOCTYPE html>
<html>
    <head>
        <title>Sistema de importação</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    </head>
    <body>
        <div class="my-container">
            <div>
                <div class="section-title">GERENCIAR DADOS</div>
                <div class="">
                    <a class="btn btn-primary" href="{{ route('importacao.store') }}"><i class="fas fa-file-import icon"></i> Importação</a>
                    <a class="btn btn-primary" href="{{ route('venda.show') }}"><i class="fas fa-shopping-cart icon"></i> Vendas</a>
                </div>
            </div>
            <div>
                <div class="section-title">INDICADORES</div>
                <div class="">
                    <a class="btn btn-primary" href="{{ route('indicadores.cliente') }}"><i class="fas fa-user-friends icon"></i> Vendas por cliente</a>
                    <a class="btn btn-primary" href="{{ route('indicadores.servico') }}"><i class="fas fa-address-book icon"></i> Vendas por serviço</a>
                    <a class="btn btn-primary" href="{{ route('indicadores.mes') }}"><i class="fas fa-address-book icon"></i> Vendas por mês</a>
                </div>
            </div>
        </div>
        <div class="center-container">
            <div>
                <div class="center-title">SISTEMA DE IMPORTAÇÃO</div>
                <div class="center-subtitle">Made with ❤️ by Aldeir Norran do Carvalho de Souza</div>
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
