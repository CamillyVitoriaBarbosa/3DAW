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
            $linha = "$idPergunta;$pergunta;$opA;$opB;$opC;$opD;$opCerta\n";
            fwrite($arqDisc, $linha);
            fclose($arqDisc);
            $msg = "Pergunta adicionada com sucesso!";
        } else {
            $msg = "Erro ao abrir o arquivo.";
        }
    }
    echo $msg;
}
?>