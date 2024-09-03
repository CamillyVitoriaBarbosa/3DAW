<?php
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = ($_POST["nome"]);
    $sigla = ($_POST["sigla"]);
    $carga = ($_POST["carga"]);

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
<html>
    <head>
        <title>Cadastro de disciplinas</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h1>Criar Nova Disciplina</h1>
        <form action="incluirDisciplina.php" method="POST">
            Nome: <input type="text" name="nome">
            <br><br>
            Sigla: <input type="text" name="sigla">
            <br><br>
            Carga Horaria: <input type="text" name="carga">
            <br><br>
            <input type="submit" value="Criar Nova Disciplina">
        </form>
        <p><?php echo $msg ?></p>
        <br>
    </body>
</html>
