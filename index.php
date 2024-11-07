<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/stylemenu.css">
        <meta charset="UTF-8">
        <title>Menu</title>
    </head>
    <body>
        <div class="header">
            <img src="img/menu.png">
    </div>
        <button onclick="redirecionarLista()" type="submit" class="botaoLista">Lista de Espera</button>
        <div class="quadrado2"></div>
        <button onclick="redirecionarCadastro()" type="submit" class="botaoCadastrar">Cadastrar Novo Gato</button>
        <div class="quadrado3"></div>
        <button onclick="redirecionarCalendario()" type="submit" class="botaoCalendario">Calendário</button>
        <div class="quadrado4"></div>

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