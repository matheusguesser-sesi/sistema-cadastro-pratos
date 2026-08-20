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
    $idPost = (int) $_POST['id'];
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $preco = $_POST['preco'];
    $categoria = trim($_POST['categoria']);
    $usuario_id = (int) $_POST['usuario_id'];

    $sql = "UPDATE pratos SET nome = ?, descricao = ?, preco = ?, categoria = ?, usuario_id = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'ssdsii', $nome, $descricao, $preco, $categoria, $usuario_id, $idPost);

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

<form action="" method="POST">
    <h1>Editar Prato:</h1>

    <input type="hidden" name="id" value="<?php echo $prato['id']; ?>">

    <label for="nome">Nome do Prato:</label>
    <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($prato['nome']); ?>" required><br><br>

    <label for="descricao">Descrição do Prato:</label>
    <input type="text" name="descricao" id="descricao" value="<?php echo htmlspecialchars($prato['descricao']); ?>" required><br><br>

    <label for="preco">Preço do Prato:</label>
    <input type="number" step="0.01" name="preco" id="preco" value="<?php echo $prato['preco']; ?>" required><br><br>

    <label for="categoria">Categoria:</label>
    <input type="text" name="categoria" id="categoria" value="<?php echo htmlspecialchars($prato['categoria']); ?>" required><br><br>

    <label for="usuario_id">Usuário responsável:</label>
    <select name="usuario_id" id="usuario_id" required>
        <?php while ($row = mysqli_fetch_assoc($usuarios)) { ?>
            <option value="<?php echo $row['id']; ?>" <?php echo ($row['id'] == $prato['usuario_id']) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($row['nome_user']); ?>
            </option>
        <?php } ?>
    </select><br><br>

    <button type="submit">Editar</button>
</form>
<button type="button" onclick="window.location.href='../index.php'">Voltar</button>

</body>
</html>