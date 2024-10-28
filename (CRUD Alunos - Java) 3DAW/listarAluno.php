<?php
$arquivo = "alunos.txt";
$alunos = [];
$msg = '';

if (file_exists($arquivo)) {
    $arqDisc = fopen($arquivo, "r");
    if ($arqDisc) {
        while (($linha = fgets($arqDisc)) !== false) {
            $alunos[] = explode(";", trim($linha));
        }
        fclose($arqDisc);
    } else {
        $msg = "Erro ao abrir o arquivo.";
    }
} else {
    $msg = "Arquivo não encontrado.";
}

header('Content-Type: application/json');
echo json_encode($alunos);
?>