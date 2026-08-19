<?php

include '../infra/conexao.php';
if(!isset($conexao) || $conexao === false) {
    die("Erro: Conexão com o banco de dados não estabelecida.");
}

$sql = "SELECT * FROM usuarios";
$resultado = $conexao->query($sql);

if ($resultado === false) {
    die("Erro na consulta: " . mysqli_error($conexao));
}











































?>