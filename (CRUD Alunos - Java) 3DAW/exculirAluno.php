<?php
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = filter_var($_POST['matricula'], FILTER_VALIDATE_INT);
    
    if ($matricula === false) {
        $msg = "Matrícula deve ser um número inteiro.";
    } elseif (empty($matricula)) {
        $msg = "O campo Matrícula deve ser preenchido.";
    } else {
        $arquivo = "alunos.txt";

        if (!file_exists($arquivo)) {
            $msg = "Arquivo de alunos não encontrado.";
            exit;
        }

        $alunos = file($arquivo, FILE_IGNORE_NEW_LINES);
        $found = false;

        foreach ($alunos as $index => $linha) {
            list($matriculaExistente) = explode(";", $linha);
            if ($matriculaExistente == $matricula) {
                unset($alunos[$index]);
                $found = true;
                break;
            }
        }

        if ($found) {
            file_put_contents($arquivo, implode("\n", $alunos));
            $msg = "Aluno excluído com sucesso!";
        } else {
            $msg = "Aluno não encontrado.";
        }
    }
    
    echo htmlspecialchars($msg);
}
?>