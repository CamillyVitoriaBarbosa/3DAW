<?php
$arquivo = "perguntas.txt";
$perguntas = [];
$perguntaBuscada = '';
$msg = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (file_exists($arquivo)) {
        $arqDisc = fopen($arquivo, "r");
        if ($arqDisc) {
            while (($linha = fgets($arqDisc)) !== false) {
                $perguntas[] = explode(";", trim($linha));
            }
            fclose($arqDisc);
        } else {
            echo "Erro ao abrir o arquivo.";
        }
        
        $perguntaBuscada = trim($_POST['pergunta']);
        
        if ($perguntaBuscada) {
            $encontrada = false;
            foreach ($perguntas as $pergunta) {
                if (strcasecmp($pergunta[0], $perguntaBuscada) == 0) {
                    $encontrada = true;
                    break;
                }
            }

            if (!$encontrada) {
                $msg = "Pergunta não encontrada.";
            }
        }
    } else {
        $msg = "Arquivo não encontrado.";
    }
}
?>