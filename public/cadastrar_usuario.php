<?php

include '../infra/conexao.php';
if(!isset($conexao) || $conexao === false) {
    die("Erro: Conexão com o banco de dados não estabelecida.");
}

if ($resultado === false) {
    die("Erro na consulta: " . mysqli_error($conexao));
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = ($_POST['nome']);
    $descricao = ($_POST['email']);


    $sql = "INSERT INTO usuarios (nome, email) VALUES (?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);

    if ($stmt === false) {
        die("Erro ao preparar consulta: " . mysqli_error($conexao));
    }

    mysqli_stmt_bind_param($stmt, 'ssdsi', $nome, $descricao, $preco, $categoria, $usuario_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Prato cadastrado!";
        echo "<br><a href='../index.php'>Voltar</a>";
        exit();
    } else {
        echo "Erro ao cadastrar prato: " . mysqli_error($conexao);
    }

    mysqli_stmt_close($stmt);
}