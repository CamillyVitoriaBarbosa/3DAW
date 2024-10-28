<?php
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    $novoId = filter_var($_POST['novo_id'], FILTER_VALIDATE_INT);
    $pergunta = filter_var($_POST['pergunta'], FILTER_SANITIZE_SPECIAL_CHARS);
    $opA = filter_var($_POST['opA'], FILTER_SANITIZE_SPECIAL_CHARS);
    $opB = filter_var($_POST['opB'], FILTER_SANITIZE_SPECIAL_CHARS);
    $opC = filter_var($_POST['opC'], FILTER_SANITIZE_SPECIAL_CHARS);
    $opD = filter_var($_POST['opD'], FILTER_SANITIZE_SPECIAL_CHARS);
    $opCerta = filter_var($_POST['opCerta'], FILTER_SANITIZE_SPECIAL_CHARS);

    if ($id === false) {
        $msg = "Id da pergunta deve ser um número inteiro.";
    }

    if (empty($novoId) || empty($id) || empty($pergunta) || empty($opA) || empty($opB) || empty($opC) || empty($opD) || empty($opCerta)) {
        $msg = "Todos os campos devem ser preenchidos.";
    } else {
        $arquivo = "perguntas.txt";

        if (!file_exists($arquivo)) {
            $msg = "Arquivo de perguntas não encontrado.";
            exit;
        }

        $perguntas = file($arquivo, FILE_IGNORE_NEW_LINES);
        $found = false;

        foreach ($perguntas as $index => $linha) {
            list($idExistente, $perguntaExistente, $opAExistente, $opBExistente, $opCExistente, $opDExistente, $opCertaExistente) = explode(";", $linha);
            if ($idExistente == $id) {
                $perguntas[$index] = $novoId . ";" . $pergunta . ";" . $opA . ";" . $opB . ";" . $opC . ";" . $opD . ";" . $opCerta;
                $found = true;
                break;
            }
        }

        if ($found) {
            file_put_contents($arquivo, implode("\n", $perguntas));
            $msg = "Pergunta atualizada com sucesso!";
        } else {
            $msg = "Pergunta não encontrada.";
        }
    }
}
?>