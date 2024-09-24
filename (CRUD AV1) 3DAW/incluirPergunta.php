<?php
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idPergunta = filter_var($_POST['idPergunta'], FILTER_VALIDATE_INT);
    $pergunta = filter_var($_POST['pergunta'], FILTER_SANITIZE_SPECIAL_CHARS);
    $opA = filter_var($_POST['opA'], FILTER_SANITIZE_SPECIAL_CHARS);
    $opB = filter_var($_POST['opB'], FILTER_SANITIZE_SPECIAL_CHARS);
    $opC = filter_var($_POST['opC'], FILTER_SANITIZE_SPECIAL_CHARS);
    $opD = filter_var($_POST['opD'], FILTER_SANITIZE_SPECIAL_CHARS);
    $opCerta = filter_var($_POST['opCerta'], FILTER_SANITIZE_SPECIAL_CHARS);
    if ($idPergunta === false) {
        $msg = "Id da pergunta deve ser um número inteiro.";
    }

    if (empty($idPergunta) || empty($pergunta) || empty($opA) || empty($opB) || empty($opC) || empty($opD) || empty($opCerta)) {
        $msg = "Todos os campos devem ser preenchidos.";
    } else {
        $arquivo = "perguntas.txt";

        if (!file_exists($arquivo)) {
            $arqDisc = fopen($arquivo, "w");
            if ($arqDisc) {
                $linha = "idPergunta;pergunta;opA;opB;opC;opD;opCerta\n";
                fwrite($arqDisc, $linha);
                fclose($arqDisc);
            } else {
                $msg = "Erro ao criar o arquivo.";
                exit;
            }
        }

        $arqDisc = fopen($arquivo, "a");
        if ($arqDisc) {
            $linha = $idPergunta . ";" . $pergunta . ";" . $opA . ";" . $opB . ";" . $opC . ";" . $opD . ";" . $opCerta . "\n";
            fwrite($arqDisc, $linha);
            fclose($arqDisc);
            $msg = "Pergunta adicionada com sucesso!";
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
    <title>Incluir Pergunta</title>
</head>
<body>
    <a href="menuPergunta.html" class="back-button">
        &#8592;
    </a>
    <div class="center-box">
        <div class="topic-header">
            <header>Cadastrar Pergunta</header>
        </div>
        <?php if (!empty($msg)): ?>
            <div class="message">
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>
        <form action="incluirPergunta.php" method="POST" class="form">
            <label for="idPergunta">Id da pergunta:</label>
            <input type="text" id="idPergunta" name="idPergunta">
            <br><br>
            <label for="pergunta">Pergunta:</label>
            <input type="text" id="pergunta" name="pergunta">
            <br><br>
            <label for="opA">Opção a:</label>
            <input type="text" id="opA" name="opA">
            <br><br>
            <label for="opB">Opção b:</label>
            <input type="text" id="opB" name="opB">
            <br><br>
            <label for="opC">Opção c:</label>
            <input type="text" id="opC" name="opC">
            <br><br>
            <label for="opD">Opção d:</label>
            <input type="text" id="opD" name="opD">
            <br><br>
            <label for="opCerta">Letra da opção certa:</label>
            <input type="text" id="opCerta" name="opCerta">
            <br><br>
            <div class="form-footer">
                <input type="submit" class="btn" value="Inserir Pergunta">
            </div>
        </form>
    </div>
</body>
</html>