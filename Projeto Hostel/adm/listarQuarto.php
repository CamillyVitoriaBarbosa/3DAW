<?php
require 'conexao.php';

$quartos = [];
$msg = "";

try {
    $stmt = $pdo->query("SELECT * FROM Quartos");
    $quartos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $msg = "Erro ao buscar os quartos: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Listar Quartos</title>
</head>
<body>
    <a href="menuadm.html" class="back-button">&#8592;</a>
    <div class="center-box">
        <header class="topic-header">Lista de Quartos</header>
        <?php if (!empty($msg)): ?>
            <div class="message"><?= htmlspecialchars($msg); ?></div>
        <?php elseif (!empty($quartos)): ?>
            <?php foreach ($quartos as $quarto): ?>
                <div class="quarto-item">
                    <h2><?= htmlspecialchars($quarto['Nome']); ?></h2>
                    <p>Capacidade: <?= htmlspecialchars($quarto['Número de camas']); ?></p>
                    <p>Tipo de Cama: <?= htmlspecialchars($quarto['Tipo de cama']); ?></p>
                    <p>Contém: <?= htmlspecialchars($quarto['Contém']); ?></p>
                    <p>Preço: R$<?= htmlspecialchars($quarto['Preço']); ?></p>
                </div>
                <hr>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum quarto cadastrado no momento.</p>
        <?php endif; ?>
    </div>
</body>
</html>