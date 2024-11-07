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
    <link rel="stylesheet" href="../pastahtml/css/stylesLista.css">
</head>
<body>
    <div class="header">
        <img src="../pastahtml/img/listaaDeEspera.png">
        <a href="../index.php" class="botaoMenu">Menu</a>
    </div>
    <div class="search-bar">
        <br><br><br><br><br><br><br><br>
        <form action="search.php" method="get">
            <input type="text" name="query" placeholder="procure um gatinho...">
            <button type="submit" id="botaopesquisar" class="botaopesquisar">Pesquisar</button>
        </form>
        <div class="result-section">
        <table>
            <thead>
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
                            <form action="search.php" method="post" style="display: inline;">
                                <input type="hidden" name="id" value="<?= $row['id_gato'] ?>">
                                <select name="prioridade" required>
                                    <option value="alta" <?= $row['prioridade'] == 'alta' ? 'selected' : '' ?>>Alta</option>
                                    <option value="media" <?= $row['prioridade'] == 'media' ? 'selected' : '' ?>>Média</option>
                                    <option value="baixa" <?= $row['prioridade'] == 'baixa' ? 'selected' : '' ?>>Baixa</option>
                                </select>
                                <button type="submit" name="salvar">Salvar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if (isset($message)) : ?>
            <p class="msgerro"><?= $message ?></p>
        <?php endif; ?>
        </div>
    </div>
</body>
</html>
