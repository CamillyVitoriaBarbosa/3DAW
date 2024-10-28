<?php
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $matricula = filter_var($_GET['matricula'], FILTER_VALIDATE_INT);
    $nome = filter_var($_GET['nome'], FILTER_SANITIZE_SPECIAL_CHARS);
    $cpf = filter_var($_GET['cpf'], FILTER_SANITIZE_SPECIAL_CHARS);
    $dtaNascimento = filter_var($_GET['dtaNascimento'], FILTER_SANITIZE_SPECIAL_CHARS);

    if ($matricula === false) {
        $msg = "Matricula deve ser um número inteiro.";
    }
    if (empty($matricula) || empty($nome) || empty($cpf) || empty($dtaNascimento)) {
        $msg = "Todos os campos devem ser preenchidos.";
    } else {
        $arquivo = "alunos.txt";
        if (!file_exists($arquivo)) {
            $arqDisc = fopen($arquivo, "w");
            if ($arqDisc) {
                $linha = "matricula;nome;cpf;dtaNascimento\n";
                fwrite($arqDisc, $linha);
                fclose($arqDisc);
            } else {
                $msg = "Erro ao criar o arquivo.";
                exit;
            }
        }
        $arqDisc = fopen($arquivo, "a");
        if ($arqDisc) {
            $linha = $matricula . ";" . $nome . ";" . $cpf . ";" . $dtaNascimento . "\n";
            fwrite($arqDisc, $linha);
            fclose($arqDisc);
            $msg = "Aluno adicionado com sucesso!";
        } else {
            $msg = "Erro ao abrir o arquivo.";
        }
    }
    echo $msg;
}
?>