<!DOCTYPE html>
<html>
    <head>
        <title>Importação de tabela excel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    </head>
    <body>
        <div class="container">
        <br />
        <h3 align="center">Importação de tabela excel</h3>
        <br />
        <div class="table-responsive">
            <span id="message"></span>
            <form method="post" id="load_excel_form" enctype="multipart/form-data" action="{{ route('importacao.store') }}">
                <table class="table">
                    <tr>
                        @csrf
                        <td width="25%" align="right">Selecione o arquivo Excel</td>
                        <td width="50%"><input type="file" name="excel" /></td>
                        <td width="25%"><input type="submit" name="Enviar" class="btn btn-primary" /></td>
                    </tr>
                </table>
            </form>
            <br />
            <div id="excel_area"></div>
        </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    </body>
</html>
