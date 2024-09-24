<?php
$arquivo = "perguntas.txt";
$perguntas = [];
$msg = '';

if (file_exists($arquivo)) {
    $arqDisc = fopen($arquivo, "r");
    if ($arqDisc) {
        while (($linha = fgets($arqDisc)) !== false) {
            $perguntas[] = explode(";", trim($linha));
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
    <title>Lista de Perguntas</title>
</head>
<body>
    <a href="menuPergunta.html" class="back-button">
        &#8592;
    </a>
    <div class="center-box">
        <div class="topic-header">
            <header>Lista de Pergunta</header>
        </div>

        <?php if (!empty($msg)): ?>
            <div class="message">
                <?php echo htmlspecialchars($msg); ?>
            </div>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Pergunta</th>
                    <th>Opção A</th>
                    <th>Opção B</th>
                    <th>Opção C</th>
                    <th>Opção D</th>
                    <th>Opção Certa</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($perguntas as $pergunta): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($pergunta[0]); ?></td>
                        <td><?php echo htmlspecialchars($pergunta[1]); ?></td>
                        <td><?php echo htmlspecialchars($pergunta[2]); ?></td>
                        <td><?php echo htmlspecialchars($pergunta[3]); ?></td>
                        <td><?php echo htmlspecialchars($pergunta[4]); ?></td>
                        <td><?php echo htmlspecialchars($pergunta[5]); ?></td>
                        <td><?php echo htmlspecialchars($pergunta[6]); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>