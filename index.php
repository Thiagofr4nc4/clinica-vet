<?php
    include "inserirNovoUsuario.php";

    $sql = "SELECT id, name, contact FROM owners";
    $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas</title>
    <link rel="stylesheet" type="text/css" href="estilo.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="script.js"></script>
</head>
<body>
    <div class="container">
        <h1>Cadastro Tutor</h1>
        <br>
        <form method="POST" id="cadastroTutor">
            <label>Nome do tutor: </label>
            <input type="text" name="nome" required>
            <br>
            <label>Contato: </label>
            <input type="text" name="contato" required>
            <br>
            <button type="submit">Cadastrar</button>
        </form>
    </div>
    <table class="tabelaEditavel">
        <thead>
            <tr>
                <th>#Id</th>
                <th>Nome</th>
                <th>Contato</th>
                <th>Pets</th>
                <th>Ações</th>
                <th>Alterar</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id'];?></td>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['contact']; ?></td>
                        <td></td>
                        <td>  <!-- botão de exclusão-->
                            <form method="POST">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete" onclick="return confirm('Tem certeza que deseja excluir este elemento?');">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Nenhum elemento encontrado</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
