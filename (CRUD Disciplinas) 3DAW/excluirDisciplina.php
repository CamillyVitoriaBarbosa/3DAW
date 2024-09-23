<?php
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sigla = filter_var($_POST['sigla'], FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($sigla)) {
        $msg = "O campo sigla deve ser preenchido.";
    } else {
        $arquivo = "disciplinas.txt";

        if (!file_exists($arquivo)) {
            $msg = "Arquivo de disciplinas não encontrado.";
            exit;
        }

        $disciplinas = file($arquivo, FILE_IGNORE_NEW_LINES);
        $found = false;

        foreach ($disciplinas as $index => $linha) {
            list($nomeExistente, $siglaExistente, $cargaExistente) = explode(";", $linha);
            if ($siglaExistente == $sigla) {
                unset($disciplinas[$index]);
                $found = true;
                break;
            }
        }

        if ($found) {
            file_put_contents($arquivo, implode("\n", $disciplinas));
            $msg = "Disciplina excluída com sucesso!";
        } else {
            $msg = "Disciplina não encontrada.";
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
    <title>Excluir Disciplina</title>
</head>
<body>
    <a href="index.html" class="back-button">
        &#8592;
    </a>
    <div class="center-box">
        <div class="topic-header">
            <header>Excluir Disciplina</header>
        </div>
        <?php if (!empty($msg)): ?>
            <div class="message">
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>
        <form action="excluirDisciplina.php" method="POST" class="form">
            <label for="sigla">Sigla da Disciplina a Excluir:</label>
            <input type="text" id="sigla" name="sigla" required>
            <br><br>
            <div class="form-footer">
                <input type="submit" class="btn" value="Excluir Disciplina">
            </div>
        </form>
    </div>
</body>
</html>