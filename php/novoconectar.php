<?php
// Configuração do banco de dados
define('HOST', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('BASE', 'novodatabase');

// Conexão com o banco de dados
$conn = mysqli_connect(HOST, USERNAME, PASSWORD, BASE);

// Verifica se houve erro na conexão
if (!$conn) {
    die("Erro de conexão: " . mysqli_connect_error());
}

// Captura os dados do formulário
$nome_gato = mysqli_real_escape_string($conn, $_POST['nome_gato']);
$sexo_gato = mysqli_real_escape_string($conn, $_POST['sexo_gato']);
$data_nasc_gato = mysqli_real_escape_string($conn, $_POST['data_nasc_gato']);
$tutor = mysqli_real_escape_string($conn, $_POST['tutor']);
$data_chegada_gato = mysqli_real_escape_string($conn, $_POST['data_chegada_gato']);
$peso_gato = mysqli_real_escape_string($conn, $_POST['peso_gato']);
// $prioridade = mysqli_real_escape_string($conn, $_POST['prioridade']);

// Insere os dados no banco
// removi prioridade
$sql = "INSERT INTO gato (nome_gato, sexo_gato, data_nasc_gato, tutor, data_chegada_gato, peso_gato) 
        VALUES ('$nome_gato', '$sexo_gato', '$data_nasc_gato', '$tutor', '$data_chegada_gato', '$peso_gato')";

echo $sql;

if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('Gato cadastrado com sucesso!');
            window.location.href = 'search.php';
          </script>";
} else {
    echo "Erro ao cadastrar gato: " . mysqli_error($conn);
}

// Fecha a conexão com o banco de dados
mysqli_close($conn);
?>
