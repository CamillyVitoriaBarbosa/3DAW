<?php
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $novaMatricula = filter_var($_GET['nova_matricula'], FILTER_VALIDATE_INT);
    $matricula = filter_var($_GET['matricula'], FILTER_VALIDATE_INT);
    $nome = filter_var($_GET['nome'], FILTER_SANITIZE_SPECIAL_CHARS);
    $cpf = filter_var($_GET['cpf'], FILTER_SANITIZE_SPECIAL_CHARS);
    $dtaNascimento = filter_var($_GET['dtaNascimento'], FILTER_SANITIZE_SPECIAL_CHARS);

    if ($novaMatricula === false) {
        $msg = "Nova matricula deve ser um número inteiro.";
    }
    if ($matricula === false) {
        $msg = "Matricula deve ser um número inteiro.";
    }
    if (empty($novaMatricula) || empty($matricula) || empty($nome) || empty($cpf) || empty($dtaNascimento)) {
        $msg = "Todos os campos devem ser preenchidos.";
    } else {
        $arquivo = "alunos.txt";
        if (!file_exists($arquivo)) {
            $msg = "Arquivo de alunos não encontrado.";
            exit;
        }
        $alunos = file($arquivo, FILE_IGNORE_NEW_LINES);
        $found = false;
        foreach ($alunos as $index => $linha) {
            list($matriculaExistente, $nomeExistente, $cpfExistente, $dtaNascimentoExistente) = explode(";", $linha);
            if ($matriculaExistente == $matricula) {
                $alunos[$index] = $novaMatricula . ";" . $nome . ";" . $cpf . ";" . $dtaNascimento;
                $found = true;
                break;
            }
        }
        if ($found) {
            file_put_contents($arquivo, implode("\n", $alunos));
            $msg = "Aluno atualizado com sucesso!";
        } else {
            $msg = "Aluno não encontrado.";
        }
    }
    echo $msg;
}
?>