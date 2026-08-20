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