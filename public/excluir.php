<?php

include "../infra/conexao.php";

$id = $_GET['id'];

$stmt = mysqli_prepare($conexao, "DELETE FROM pratos WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);

if (mysqli_stmt_execute($stmt)) {
    echo "Prato excluído com sucesso.";
    echo "<br><a href='../index.php'>Voltar</a>";
} else {
    echo "Erro ao excluir prato: " . mysqli_error($conexao);
}

mysqli_stmt_close($stmt);

?>