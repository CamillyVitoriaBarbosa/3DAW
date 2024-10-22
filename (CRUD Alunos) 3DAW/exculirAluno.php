<?php
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = filter_var($_POST['matricula'], FILTER_VALIDATE_INT);
    if ($matricula === false) {
        $msg = "Matricula deve ser um número inteiro.";
    }
    
    if (empty($matricula)) {
        $msg = "O campo Matrícula deve ser preenchido.";
    } else {
        $arquivo = "alunos.txt";

        if (!file_exists($arquivo)) {
            $msg = "Arquivo de alunos não encontrado.";
            exit;
        }

        $alunos = file($arquivo, FILE_IGNORE_NEW_LINES);
        $found = false;

        foreach ($alunos as $index => $linha) {
            list($matriculaExistente, $nomeExistente, $cpfExistente, $dtaNascimentoExistente) = explode(";", $linha);
            if ($matriculaExistente == $matricula) {
                unset($alunos[$index]);
                $found = true;
                break;
            }
        }

        if ($found) {
            file_put_contents($arquivo, implode("\n", $alunos));
            $msg = "Aluno excluído com sucesso!";
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
    <title>Excluir Aluno</title>
</head>
<body>
    <a href="index.html" class="back-button">
        &#8592;
    </a>
    <div class="center-box">
        <div class="topic-header">
            <header>Excluir Aluno</header>
        </div>
        <?php if (!empty($msg)): ?>
            <div class="message">
                <?php echo htmlspecialchars($msg); ?>
            </div>
        <?php endif; ?>
        <form action="excluirAluno.php" method="POST" class="form">
            <label for="matricula">Matrícula do Aluno a Excluir:</label>
            <input type="text" id="matricula" name="matricula" required>
            <br><br>
            <div class="form-footer">
                <input type="submit" class="btn" value="Excluir Aluno">
            </div>
        </form>
    </div>
</body>
</html>
