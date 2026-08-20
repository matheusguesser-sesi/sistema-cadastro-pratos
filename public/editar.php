<?php

include '../infra/conexao.php';
if(!isset($conexao) || $conexao === false) {
    die("Erro: Conexão com o banco de dados não estabelecida.");
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