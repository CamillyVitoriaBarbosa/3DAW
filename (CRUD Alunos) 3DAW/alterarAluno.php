<?php
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $novaMatricula = filter_var($_POST['nova_matricula'], FILTER_VALIDATE_INT);
    $matricula = filter_var($_POST['matricula'], FILTER_VALIDATE_INT);
    $nome = filter_var($_POST['nome'], FILTER_SANITIZE_SPECIAL_CHARS);
    $cpf = filter_var($_POST['cpf'], FILTER_SANITIZE_SPECIAL_CHARS);
    $dtaNascimento = filter_var($_POST['dtaNascimento'], FILTER_SANITIZE_SPECIAL_CHARS);
    if ($novaMatricula === false) {
        $msg = "Matricula do Aluno deve ser um número inteiro.";
    }

    if ($matricula === false) {
        $msg = "Matricula do Aluno deve ser um número inteiro.";
    }

    if (empty($novaMatricula) || empty($matricula) || empty($nome) || empty($cpf) || empty($dtaNascimento)) {
        $msg = "Todos os campos devem ser preenchidos.";
    } else {
        $arquivo = "alunos.txt";

        if (!file_exists($arquivo)) {
            $msg = "Arquivo de perguntas não encontrado.";
            exit;
        }

        $alunos = file($arquivo, FILE_IGNORE_NEW_LINES);
        $found = false;

        foreach ($alunos as $index => $linha) {
            list($matriculaidExistente, $nomeExistente, $cpfExistente, $dtaNascimentoExistente) = explode(";", $linha);
            if ($matriculaExistente == $matricula) {
                $alunos[$index] = $matricula . ";" . $nome . ";" . $cpf . ";" . $dtaNascimento;
                $found = true;
                break;
            }
        }

        if ($found) {
            file_put_contents($arquivo, implode("\n", $alunos));
            $msg = "Aluno atualizada com sucesso!";
        } else {
            $msg = "Aluno não encontrado.";
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
    <title>Alterar Aluno</title>
</head>
<body>
    <a href="index.html" class="back-button">
        &#8592;
    </a>
    <div class="center-box">
        <div class="topic-header">
            <header>Alterar Aluno</header>
        </div>
        <?php if (!empty($msg)): ?>
            <div class="message">
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>
        <form action="alterarAluno.php" method="POST" class="form">
            <label for="matricula">Matricula do Aluno a alterar:</label>
            <input type="text" id="matricula" name="matricula" required>
            <br><br>
            <label for="nova_matricula">Nova matricula do Aluno:</label>
            <input type="text" id="nova_matricula" name="nova_matricula" required>
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
                <input type="submit" class="btn" value="Alterar Aluno">
            </div>
        </form>
    </div>
</body>
</html>