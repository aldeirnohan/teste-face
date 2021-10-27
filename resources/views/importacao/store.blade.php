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
        <h3 class="section-title" align="center">Importação de tabela excel</h3>
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
