<?php

include '../infra/conexao.php';
if(!isset($conexao) || $conexao === false) {
    die("Erro: Conexão com o banco de dados não estabelecida.");
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = ($_POST['nome']);
    $email = ($_POST['email']);


    $sql = "INSERT INTO usuarios (nome, email) VALUES (?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);

    if ($stmt === false) {
        die("Erro ao preparar consulta: " . mysqli_error($conexao));
    }

    mysqli_stmt_bind_param($stmt, 'ss', $nome, $email);

    if (mysqli_stmt_execute($stmt)) {
        echo "Usuário cadastrado!";
        echo "<br><a href='../index.php'>Voltar</a>";
        exit();
    } else {
        echo "Erro ao cadastrar usuário: " . mysqli_error($conexao);
    }

    mysqli_stmt_close($stmt);
}

<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Cadastrar Usuário</title>    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
     

    <form action="../src/cadastrar_usuario.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required><br> <br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br> <br>

        <input type="submit" value="Cadastrar">

    </form>

    <button onclick="window.location.href='index.php'"> Voltar </button>

</body>
</html>