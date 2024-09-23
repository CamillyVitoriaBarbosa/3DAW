<?php
$arquivo = "disciplinas.txt";
$disciplinas = [];
$msg = '';

if (file_exists($arquivo)) {
    $arqDisc = fopen($arquivo, "r");
    if ($arqDisc) {
        while (($linha = fgets($arqDisc)) !== false) {
            $disciplinas[] = explode(";", trim($linha));
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
    <title>Lista de Disciplinas</title>
</head>
<body>
    <a href="index.html" class="back-button">
        &#8592;
    </a>
    <div class="center-box">
        <div class="topic-header">
            <header>Lista de Disciplina</header>
        </div>

        <?php if (!empty($msg)): ?>
            <div class="message">
                <?php echo htmlspecialchars($msg); ?>
            </div>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Sigla</th>
                    <th>Carga Horária</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($disciplinas as $disciplina): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($disciplina[0]); ?></td>
                        <td><?php echo htmlspecialchars($disciplina[1]); ?></td>
                        <td><?php echo htmlspecialchars($disciplina[2]); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>