<?php
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = filter_var($_POST['nome'], FILTER_SANITIZE_SPECIAL_CHARS);
    $sigla = filter_var($_POST['sigla'], FILTER_SANITIZE_SPECIAL_CHARS);
    $carga = filter_var($_POST['carga'], FILTER_VALIDATE_INT);
    if ($carga === false) {
        $msg = "Carga Horária deve ser um número inteiro.";
    }

    if (empty($nome) || empty($sigla) || empty($carga)) {
        $msg = "Todos os campos devem ser preenchidos.";
    } else {
        $arquivo = "disciplinas.txt";

        if (!file_exists($arquivo)) {
            $arqDisc = fopen($arquivo, "w");
            if ($arqDisc) {
                $linha = "nome;sigla;carga\n";
                fwrite($arqDisc, $linha);
                fclose($arqDisc);
            } else {
                $msg = "Erro ao criar o arquivo.";
                exit;
            }
        }

        $arqDisc = fopen($arquivo, "a");
        if ($arqDisc) {
            $linha = $nome . ";" . $sigla . ";" . $carga . "\n";
            fwrite($arqDisc, $linha);
            fclose($arqDisc);
            $msg = "Disciplina adicionada com sucesso!";
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
    <title>Incluir Disciplina</title>
</head>
<body>
    <div class="center-box">
        <div class="topic-header">
            <header>Cadastrar Disciplina</header>
        </div>
        <?php if (!empty($msg)): ?>
            <div class="message">
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>
        <form action="incluirDisciplina.php" method="POST" class="form">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome">
            <br><br>
            <label for="sigla">Sigla:</label>
            <input type="text" id="sigla" name="sigla">
            <br><br>
            <label for="carga">Carga Horária:</label>
            <input type="text" id="carga" name="carga">
            <br><br>
            <div class="form-footer">
                <input type="submit" class="btn" value="Inserir Disciplina">
            </div>
        </form>
    </div>
</body>
</html>