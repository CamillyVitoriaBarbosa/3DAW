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
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Lista de Alunos</title>
</head>
<body>
    <a href="menuAluno.html" class="back-button">
        &#8592;
    </a>
    <div class="center-box">
        <div class="topic-header">
            <header>Lista de Alunos</header>
        </div>

        <?php if (!empty($msg)): ?>
            <div class="message">
                <?php echo htmlspecialchars($msg); ?>
            </div>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>Matrícula</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Data de Nascimento</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alunos as $aluno): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($aluno[0]); ?></td>
                        <td><?php echo htmlspecialchars($aluno[1]); ?></td>
                        <td><?php echo htmlspecialchars($aluno[2]); ?></td>
                        <td><?php echo htmlspecialchars($aluno[3]); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
