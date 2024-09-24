<?php
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = filter_var($_POST['nome'], FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);
    $senha = filter_var($_POST['senha'], FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($nome) || empty($email) || empty($senha)) {
        $msg = "Todos os campos devem ser preenchidos.";
    } else {
        $arquivo = "usuarios.txt";

        if (!file_exists($arquivo)) {
            $arqDisc = fopen($arquivo, "w");
            if ($arqDisc) {
                $linha = "nome;email;senha\n";
                fwrite($arqDisc, $linha);
                fclose($arqDisc);
            } else {
                $msg = "Erro ao criar o arquivo.";
                exit;
            }
        }

        $arqDisc = fopen($arquivo, "a");
        if ($arqDisc) {
            $linha = $nome . ";" . $email . ";" . $senha . "\n";
            fwrite($arqDisc, $linha);
            fclose($arqDisc);
            $msg = "Usuário adicionado com sucesso!";
        } else {
            $msg = "Erro ao abrir o arquivo.";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Incluir Usuário</title>
</head>
<body>
    <a href="menuUsuario.html" class="back-button">
        &#8592;
    </a>
    <div class="center-box">
        <div class="topic-header">
            <header>Cadastrar Usuário</header>
        </div>
        <?php if (!empty($msg)): ?>
            <div class="message">
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>
        <form action="incluirUsuario.php" method="POST" class="form">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome">
            <br><br>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email">
            <br><br>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha">
            <br><br>
            <div class="form-footer">
                <input type="submit" class="btn" value="Inserir Usuário">
            </div>
        </form>
    </div>
</body>
</html>