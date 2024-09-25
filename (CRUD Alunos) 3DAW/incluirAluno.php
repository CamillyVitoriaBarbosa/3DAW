<?php
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = filter_var($_POST['matricula'], FILTER_VALIDATE_INT);
    $nome = filter_var($_POST['nome'], FILTER_SANITIZE_SPECIAL_CHARS);
    $cpf = filter_var($_POST['cpf'], FILTER_SANITIZE_SPECIAL_CHARS);
    $dtaNascimento = filter_var($_POST['dtaNascimento'], FILTER_SANITIZE_SPECIAL_CHARS);
    if ($matricula === false) {
        $msg = "Matricula deve ser um número inteiro.";
    }

    if (empty($matricula) || empty($nome) || empty($cpf) || empty($dtaNascimento)) {
        $msg = "Todos os campos devem ser preenchidos.";
    } else {
        $arquivo = "alunos.txt";

        if (!file_exists($arquivo)) {
            $arqDisc = fopen($arquivo, "w");
            if ($arqDisc) {
                $linha = "matricula;nome;cpf;dtaNascimento\n";
                fwrite($arqDisc, $linha);
                fclose($arqDisc);
            } else {
                $msg = "Erro ao criar o arquivo.";
                exit;
            }
        }

        $arqDisc = fopen($arquivo, "a");
        if ($arqDisc) {
            $linha = $matricula . ";" . $nome . ";" . $cpf . ";" . $dtaNascimento . "\n";
            fwrite($arqDisc, $linha);
            fclose($arqDisc);
            $msg = "Aluno adicionada com sucesso!";
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
    <title>Incluir Aluno</title>
</head>
<body>
    <a href="index.html" class="back-button">
        &#8592;
    </a>
    <div class="center-box">
        <div class="topic-header">
            <header>Cadastrar Aluno</header>
        </div>
        <?php if (!empty($msg)): ?>
            <div class="message">
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>
        <form action="incluirAluno.php" method="POST" class="form">
            <label for="matricula">Matricula:</label>
            <input type="text" id="matricula" name="matricula">
            <br><br>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome">
            <br><br>
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf">
            <br><br>
            <label for="dtaNascimento">Data de nascimento:</label>
            <input type="text" id="dtaNascimento" name="dtaNascimento">
            <br><br>
            <div class="form-footer">
                <input type="submit" class="btn" value="Inserir Aluno">
            </div>
        </form>
    </div>
</body>
</html>