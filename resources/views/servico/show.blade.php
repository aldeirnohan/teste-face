<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Serviços</title>
    </head>
    <body>
        @foreach($mounted_servicos as $mounted_servico)
            <h1>{{ $mounted_servico['id'] }} Descrição do serviço: {{ $mounted_servico['descricao'] }}</h1>
            <h2>Valor por hora de serviço: R${{ $mounted_servico['valor_hora'] }}</h2>
        @endforeach
    </body>
</html>
