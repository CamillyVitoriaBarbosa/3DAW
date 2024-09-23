<?php
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = filter_var($_POST['nome'], FILTER_SANITIZE_SPECIAL_CHARS);
    $sigla = filter_var($_POST['sigla'], FILTER_SANITIZE_SPECIAL_CHARS);
    $novaSigla = filter_var($_POST['nova_sigla'], FILTER_SANITIZE_SPECIAL_CHARS);
    $carga = filter_var($_POST['carga'], FILTER_VALIDATE_INT);

    if ($carga === false) {
        $msg = "Carga Horária deve ser um número inteiro.";
    }

    if (empty($nome) || empty($sigla) || empty($carga) || empty($novaSigla)) {
        $msg = "Todos os campos devem ser preenchidos.";
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
                $disciplinas[$index] = $nome . ";" . $novaSigla . ";" . $carga;
                $found = true;
                break;
            }
        }

        if ($found) {
            file_put_contents($arquivo, implode("\n", $disciplinas));
            $msg = "Disciplina atualizada com sucesso!";
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
    <title>Alterar Disciplina</title>
</head>
<body>
    <a href="index.html" class="back-button">
        &#8592;
    </a>
    <div class="center-box">
        <div class="topic-header">
            <header>Alterar Disciplina</header>
        </div>
        <?php if (!empty($msg)): ?>
            <div class="message">
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>
        <form action="alterarDisciplina.php" method="POST" class="form">
            <label for="sigla">Sigla da Disciplina a Alterar:</label>
            <input type="text" id="sigla" name="sigla" required>
            <br><br>
            <label for="nova_sigla">Nova Sigla:</label>
            <input type="text" id="nova_sigla" name="nova_sigla" required>
            <br><br>
            <label for="nome">Novo Nome:</label>
            <input type="text" id="nome" name="nome" required>
            <br><br>
            <label for="carga">Nova Carga Horária:</label>
            <input type="text" id="carga" name="carga" required>
            <br><br>
            <div class="form-footer">
                <input type="submit" class="btn" value="Alterar Disciplina">
            </div>
        </form>
    </div>
</body>
</html>