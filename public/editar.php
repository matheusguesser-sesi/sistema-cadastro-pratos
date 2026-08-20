<?php

include '../infra/conexao.php';
if(!isset($conexao) || $conexao === false) {
    die("Erro: Conexão com o banco de dados não estabelecida.");
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$sql = "SELECT * FROM pratos WHERE id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$resultadoPrato = mysqli_stmt_get_result($stmt);
$prato = mysqli_fetch_assoc($resultadoPrato);

if (!$prato){
    die('Prato não encontrado');
}

$usuarios = mysqli_query($conexao, "SELECT id, nome_user FROM usuarios");

if(!$usuarios){
    die("Erro na consulta: " . mysqli_error($conexao));
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $preco = $_POST['preco'];
    $categoria = trim($_POST['categoria']);
    $nome_user = trim($_POST['nome_user']);

    $sql = "UPDATE pratos SET nome_prato = ?, descricao = ?, preco = ?, categoria = ?, nome_user = ? WHERE idprato = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'ssdsss', $nome_prato, $descricao, $preco, $categoria, $nome_user, $idprato);

    if (mysqli_stmt_execute($stmt)) {
        echo "Prato atualizado!";
        echo "<br><a href='../index.php'>Voltar</a>";
        exit();
    } else {
        echo "Erro ao atualizar prato: " . mysqli_error($conexao);
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Prato</title>
</head>
<body>
    

<form action="../infra/editar_prato.php" method="POST">
    <h1>Editar Prato:</h1>
    <label for="id">ID:</label>
    <input type="text" name="id" id="id" required><br><br>

    <label for="nome">Nome do Prato:</label>
    <input type="text" name="nome" id="nome" required><br><br>

    <label for="descricao">Descrição do Prato:</label>
    <input type="text" name="descricao" id="descricao" required><br><br>

    <label for="preco">Preço do Prato:</label>
    <input type="number" step="0.01" name="preco" id="preco" required><br><br>

    <label for="categoria">Categoria:</label>
    <input type="text" name="categoria" id="categoria" required><br><br>

    <?php
    while ($row = mysqli_fetch_assoc($usuarios)) {
        echo '<option value="' . $row['id'] . '">' . $row['nome'] . '</option>';
    }
    ?>


        </select><br><br>
        <button type="submit">Editar</button>
</form>
<button type="button" onclick="window.location.href='index.php'">Voltar</button>

</body>
</html>