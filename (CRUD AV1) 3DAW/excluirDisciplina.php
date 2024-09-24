<?php
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    if ($id === false) {
        $msg = "Id da pergunta deve ser um número inteiro.";
    }

    if (empty($id)) {
        $msg = "O campo Id da pergunta deve ser preenchido.";
    } else {
        $arquivo = "perguntas.txt";

        if (!file_exists($arquivo)) {
            $msg = "Arquivo de perguntas não encontrado.";
            exit;
        }

        $perguntas = file($arquivo, FILE_IGNORE_NEW_LINES);
        $found = false;

        foreach ($perguntas as $index => $linha) {
            list($idPerguntaExistente, $perguntaExistente, $opAExistente, $opBExistente, $opCExistente, $opDExistente, $opCertaExistente) = explode(";", $linha);
            if ($idExistente == $id) {
                unset($perguntas[$index]);
                $found = true;
                break;
            }
        }

        if ($found) {
            file_put_contents($arquivo, implode("\n", $perguntas));
            $msg = "Pergunta excluída com sucesso!";
        } else {
            $msg = "Pergunta não encontrada.";
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
    <title>Excluir Pergunta</title>
</head>
<body>
    <a href="menuPergunta.html" class="back-button">
        &#8592;
    </a>
    <div class="center-box">
        <div class="topic-header">
            <header>Excluir Pergunta</header>
        </div>
        <?php if (!empty($msg)): ?>
            <div class="message">
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>
        <form action="excluirPergunta.php" method="POST" class="form">
            <label for="id">Id da Pergunta a Excluir:</label>
            <input type="text" id="id" name="id" required>
            <br><br>
            <div class="form-footer">
                <input type="submit" class="btn" value="Excluir Pergunta">
            </div>
        </form>
    </div>
</body>
</html>