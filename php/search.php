<?php
define('HOST', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('BASE', 'novodatabase');

$conn = mysqli_connect(HOST, USERNAME, PASSWORD, BASE);

if (!$conn) {
    die("Erro de conexão: " . mysqli_connect_error());
}

$query = isset($_GET['query']) ? mysqli_real_escape_string($conn, $_GET['query']) : "";

$sql = "SELECT * FROM gato WHERE nome_gato LIKE '%$query%'";
$result = $conn->query($sql);

$results = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }
} else {
    $message = "Nenhum resultado encontrado.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['salvar'])) {
    $id = intval($_POST['id']);
    $novaPrioridade = mysqli_real_escape_string($conn, $_POST['prioridade']);
    
    $updateSql = "UPDATE gato SET prioridade='$novaPrioridade' WHERE id_gato=$id";
    mysqli_query($conn, $updateSql);
    
    header("Location: search.php?query=$query" . urlencode($_GET['query']));
    exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Espera</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../pastahtml/css/stylesLista.css">
</head>
<body>
    <div class="header">
        <img src="../pastahtml/img/headergeral.png" class="img-fluid" alt="img lista de espera">
        <div class="btnMenu">
            <a href="../index.php" class="btn btn-dark">Menu</a> <!-- muda o botao bootstrap -->
        </div>
    </div>

    <!-- barra de pesquisa -->
     <div class="container mt-5">
        <div class="search-bar">
            <br><br><br><br><br>
            <form action="search.php" method="get" class="row g-3"> <!-- deixa a search bar mais no cantinho -->
                <input type="text" name="query" placeholder="procure um gatinho...">
                <button type="submit" id="botaopesquisar" class="btn btn-dark mb-2">Pesquisar</button>
            </form>
        </div>

        <div class="result-section mt-4 table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Nome</th>
                    <th>Sexo</th>
                    <th>Nascimento</th>
                    <th>Tutor</th>
                    <th>Chegada</th>
                    <th>Peso</th>
                    <th>Prioridade</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nome_gato']) ?></td>
                        <td><?= htmlspecialchars($row['sexo_gato']) ?></td>
                        <td><?= htmlspecialchars($row['data_nasc_gato']) ?></td>
                        <td><?= htmlspecialchars($row['tutor']) ?></td>
                        <td><?= htmlspecialchars($row['data_chegada_gato']) ?></td>
                        <td><?= htmlspecialchars($row['peso_gato']) ?></td>
                        <td>
                            <form action="search.php" method="post" class="d-inline;">
                                <input type="hidden" name="id" value="<?= $row['id_gato'] ?>">
                                <select name="prioridade" class="form-select form-select-sm d-inline w-auto" required> deixa os botoes de salvar alinhados com o espaco para editar
                                    <option value="alta" <?= $row['prioridade'] == 'alta' ? 'selected' : '' ?>>Alta</option>
                                    <option value="media" <?= $row['prioridade'] == 'media' ? 'selected' : '' ?>>Média</option>
                                    <option value="baixa" <?= $row['prioridade'] == 'baixa' ? 'selected' : '' ?>>Baixa</option>
                                </select>
                                <button type="submit" name="salvar" class="btn btn-sm btn-outline-dark">Salvar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if (isset($message)) : ?>
            <p class="msgerro text-danger text-center"><?= $message ?></p>
        <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-VPHoArf7Gc7njYbryAo2U4eDNz7pD+KzPzstAsREI1kqk5XyAiAQj+CNZk/iPEvJ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
