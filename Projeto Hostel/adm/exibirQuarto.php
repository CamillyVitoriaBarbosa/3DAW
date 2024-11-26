<?php
require 'conexao.php';
$quarto = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = filter_input(INPUT_POST, 'nome_quarto', FILTER_SANITIZE_SPECIAL_CHARS);

    try {
        $stmt = $pdo->prepare("SELECT * FROM Quartos WHERE Nome = ?");
        $stmt->execute([$nome]);
        $quarto = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $msg = "Erro: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Exibir Quarto</title>
</head>
<body>
    <a href="menuadm.html" class="back-button">&#8592;</a>
    <div class="center-box">
        <header class="topic-header">Exibir Quarto</header>
        <form method="POST">
            <label for="nome_quarto">Nome do Quarto:</label>
            <input type="text" id="nome_quarto" name="nome_quarto" required>
            <button type="submit" class="btn">Buscar</button>
        </form>
        <div id="quartoDetalhes">
            <?php if ($quarto): ?>
                <h2><?= htmlspecialchars($quarto['Nome']); ?></h2>
                <p>Capacidade: <?= htmlspecialchars($quarto['Número de camas']); ?></p>
                <p>Tipo de Cama: <?= htmlspecialchars($quarto['Tipo de cama']); ?></p>
                <p>Preço: R$<?= htmlspecialchars($quarto['Preço']); ?></p>
                <p>Contém: <?= htmlspecialchars($quarto['Contém']); ?></p>
            <?php else: ?>
                <p>Quarto não encontrado.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>