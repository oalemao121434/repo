<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

    <?php
    // Receber os dados do formulário
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    // Acessar o IF quando o usuário clicar no botão acessar do formulário
    if (!empty($dados['sendLogin'])) {
        var_dump($dados);
    }
    ?>

    <h2>Formulário de Login</h2>

    <form method="POST" action="">
        <label for="usuario">Usuário:</label>
        <input type="text" name="usuario" id="usuario" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required><br><br>

        <input type="submit" name="sendLogin" value="Acessar">
    </form>

</body>
</html>
