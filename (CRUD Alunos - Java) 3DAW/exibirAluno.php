<?php
$arquivo = "alunos.txt";
$alunos = [];
$matriculaBuscada = '';
$msg = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
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

        $matriculaBuscada = trim($_POST['matricula']);

        if ($matriculaBuscada) {
            $encontrada = false;
            foreach ($alunos as $aluno) {
                if (strcasecmp($aluno[0], $matriculaBuscada) == 0) {
                    $encontrada = true;
                    break;
                }
            }

            if (!$encontrada) {
                $msg = "Aluno não encontrado.";
            }
        }
    } else {
        $msg = "Arquivo não encontrado.";
    }
}
?>