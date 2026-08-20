<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Usuário</title>
    <link rel="stylesheet" href="style/styles.css">
</head>
<body>
    
    <main>
        <h1>Gerenciar Pratos</h1>
        <a href="public/cadastrar_prato.php">Cadastrar Prato</a>
        <a href="public/cadastrar_usuario.php">Cadastrar Usuário</a>
        <br><br>

</body>
</html>

<?php

include "infra/conexao.php";

$sql = "SELECT pratos.id, pratos.nome, pratos.descricao, pratos.preco,
               pratos.categoria, usuarios.nome_user AS usuario
        FROM pratos
        INNER JOIN usuarios ON pratos.usuario_id = usuarios.id
        ORDER BY pratos.id DESC";

$pratos = mysqli_query($conexao, $sql);

$usuarios = mysqli_query($conexao, "SELECT id, nome_user FROM usuarios ORDER BY nome_user");

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pratos</title>
    <link rel="stylesheet" href="style/styles.css">
</head>

<body>

        <div>

            <h2>Pratos Cadastrados</h2>

            <table>

                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                    <th>Usuário</th>
                    <th>Ações</th>
                </tr>

                <?php while ($prato = mysqli_fetch_assoc($pratos)) { ?>

                    <tr>

                        <td>
                            <?php echo $prato["id"]; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($prato["nome"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($prato["descricao"]); ?>
                        </td>

                        <td>
                            R$ <?php echo number_format($prato["preco"], 2, ',', '.'); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($prato["categoria"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($prato["usuario"]); ?>
                        </td>

                        <td>
                            <a href="public/editar.php?id=<?php echo $prato["id"]; ?>">
                                Editar
                            </a>

                            <a href="public/excluir.php?id=<?php echo $prato["id"]; ?>"
                               onclick="return confirm('Tem certeza que deseja excluir este prato?');">
                                Excluir
                            </a>
                        </td>

                    </tr>

                <?php } ?>

            </table>

        </div>

    </main>

    <footer>

    </footer>

</body>

</html>
