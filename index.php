<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="./pastahtml/css/stylemenu.css">
        <title>Menu</title>
    </head>
    <body>
        <div class="header">
            <img src="./pastahtml/img/menu.png" class="img-fluid">
        </div>
    <div class="row justify-content-center mt-2">
        <button onclick="redirecionarLista()" type="submit" class="btn btn-light botaoLista">Lista de Espera</button>
    </div>
    <div class="row justify-content-center mt-2">
        <button onclick="redirecionarCadastro()" type="submit" class="btn btn-light botaoCadastrar">Cadastrar Novo Gato</button>
    </div>
    <div class="row justify-content-center mt-2">
        <button onclick="redirecionarCalendario()" type="submit" class="btn btn-light botaoCalendario">Calendário</button>
    </div>
        <script>
        function redirecionarCalendario() {
            window.location.href = "pastahtml/vagas2.html";
        }
        
        function redirecionarLista() {
            window.location.href = "php/search.php";
        }
        
        function redirecionarCadastro() {
            window.location.href = "pastahtml/novocadastro.html";
        }</script>
    </body>
</html>