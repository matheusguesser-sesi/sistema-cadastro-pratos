<?php

include "infra/conexao.php";
$livros = mysqli_query($conexao, "SELECT * FROM livros");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Prato</title>
    <link rel="stylesheet" href="style/styles.css">
</head>

<body>
    <header>
        <h1>CRUD - Prato</h1>
    </header>
    <main>
        <h2>Adicione um novo livro!</h2>
        <form action="public/cadastrar.php" method="POST">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo">
            <br>
            <label for="autor">Autor:</label>
            <input type="text" name="autor">
            <br>
            <label for="ano">Ano de Publicação:</label>
            <input type="number" name="ano">
            <br>
            <button type="submit">Cadastrar</button>
        </form>
        <div>
            <h2> Pratos Cadastrados</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Ano</th>
                    <th>Ações</th>
                </tr>
                <?php while ($livro = mysqli_fetch_assoc($livros)) { ?>
                    <tr>
                        <td><?php echo $livro["id"] ?></td>
                        <td><?php echo $livro["titulo"] ?></td>
                        <td><?php echo $livro["autor"] ?></td>
                        <td><?php echo $livro["ano"] ?></td>
                        <td>
                            <a href="public/editar.php?id=<?php echo $livro["id"] ?>">Editar</a>
                            <a href="public/excluir.php?id=<?php echo $livro["id"] ?>">Excluir</a>
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