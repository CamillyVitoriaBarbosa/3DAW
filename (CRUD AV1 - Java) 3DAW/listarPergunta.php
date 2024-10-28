<?php
header('Content-Type: application/json');

$arquivo = "perguntas.txt";
$perguntas = [];

if (file_exists($arquivo)) {
    $arqDisc = fopen($arquivo, "r");
    if ($arqDisc) {
        while (($linha = fgets($arqDisc)) !== false) {
            $perguntas[] = explode(";", trim($linha));
        }
        fclose($arqDisc);
    } else {
        http_response_code(500);
        echo json_encode(["msg" => "Erro ao abrir o arquivo."]);
        exit;
    }
} else {
    http_response_code(404);
    echo json_encode(["msg" => "Arquivo não encontrado."]);
    exit;
}

echo json_encode($perguntas);
?>