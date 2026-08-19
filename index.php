<?php

include "infra/conexao.php";

$sql = "SELECT pratos.id, pratos.nome, pratos.descricao, pratos.preco,
               pratos.categoria, usuarios.nome AS usuario
        FROM pratos
        INNER JOIN usuarios ON pratos.usuario_id = usuarios.id
        ORDER BY pratos.id DESC";

$pratos = mysqli_query($conexao, $sql);

$usuarios = mysqli_query($conexao, "SELECT id, nome FROM usuarios ORDER BY nome");

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

    <header>
        <h1>​Cadastro de Pratos​</h1>
    </header>

    <main>

        <h2>Adicione um novo prato!</h2>

        <form action="public/cadastrar.php" method="POST">

            <label for="nome">Nome do prato:</label>
            <input type="text" id="nome" name="nome" required>
            <br>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required></textarea>
            <br>

            <label for="preco">Preço:</label>
            <input type="number" id="preco" name="preco" step="0.01" min="0" required>
            <br>

            <label for="categoria">Categoria:</label>
            <input type="text" id="categoria" name="categoria" required>
            <br>

            <label for="usuario_id">Usuário responsável:</label>
            <select id="usuario_id" name="usuario_id" required>
                <option value="">Selecione um usuário</option>

                <?php while ($usuario = mysqli_fetch_assoc($usuarios)) { ?>
                    <option value="<?php echo $usuario["id"]; ?>">
                        <?php echo htmlspecialchars($usuario["nome"]); ?>
                    </option>
                <?php } ?>

            </select>

            <br>

            <button type="submit">Cadastrar Prato</button>

        </form>


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
