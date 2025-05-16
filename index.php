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

<?php
// Exemplo criptografar a senha
// echo password_hash(123456, PASSWORD_DEFAULT);

// Receber os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// Acessar o if quando o usuário clicar no botão acessar do formulário
if (!empty($dados['senhaLogin'])) {

    // Recuperar os dados do usuário no banco de dados
    $query_usuario = "SELECT id, nome, usuario, senha_usuario
                    FROM usuarios
                    WHERE usuario = :usuario
                    LIMIT 1";
    
    // Preparar a query
    $result_usuario = $conn->prepare($query_usuario);

    // Substituir o link da query pelo valor que vem do formulário
    $result_usuario->bindParam(':usuario', $dados['usuario']);

    // Executar a query
    $result_usuario->execute();

    // Acessar o IF quando encontrar usuário no banco de dados
    if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
        // Ler os registros retornado do banco de dados
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
        //var_dump($row_usuario);

        // Acessar o IF quando a senha é válida
        if (password_verify($dados['senha_usuario'], $row_usuario['senha_usuario'])) {
            // Criar a sessão do usuário e salvar os dados na sessão
            $_SESSION['id'] = $row_usuario['id'];
            $_SESSION['nome'] = $row_usuario['nome'];
            $_SESSION['usuario'] = $row_usuario['usuario'];

            // Recuperar a data atual
            $data = date("Y-m-d H:i:s");

            // Gerar número randômico entre 100000 e 999999
            $codigo_autenticacao = rand(100000, 999999);
            //var_dump($codigo_autenticacao);

            // QUERY para salvar no banco de dados o código e a data gerada
            $query_up_usuario = "UPDATE usuarios SET
                        codigo_autenticacao = :codigo_autenticacao,
                        data_codigo_autenticacao = :data_codigo_autenticacao
                        WHERE id = :id
                        LIMIT 1";

            // Preparar a query
            $result_up_usuario = $conn->prepare($query_up_usuario);

            // Substituir o link da query pelos valores
            $result_up_usuario->bindParam(':codigo_autenticacao', $codigo_autenticacao);
            $result_up_usuario->bindParam(':data_codigo_autenticacao', $data);
            $result_up_usuario->bindParam(':id', $row_usuario['id']);

            // Executar a query
            $result_up_usuario->execute();

            // Incluir o composer
            require './lib/vendor/autoload.php';

            // Criar o objeto e instanciar a classe do PHPMailer
            $mail = new PHPMailer(true);

            // Verificação de envio e e-mail corretamente com try catch
            try {
                // Imprimir os erros do e-mail
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;


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
