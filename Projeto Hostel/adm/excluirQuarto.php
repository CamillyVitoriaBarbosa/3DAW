<?php
require 'conexao.php';
$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);

    if (!$nome) {
        $msg = "O nome do quarto é obrigatório.";
    } else {
        try {
            $stmt = $pdo->prepare("DELETE FROM Quartos WHERE Nome = ?");
            $success = $stmt->execute([$nome]);
            $msg = $success ? "Quarto excluído com sucesso!" : "Erro ao excluir quarto.";
        } catch (PDOException $e) {
            $msg = "Erro: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Excluir Quarto</title>
</head>
<body>
    <a href="menuadm.html" class="back-button">&#8592;</a>
    <div class="center-box">
        <header class="topic-header">Excluir Quarto</header>
        <div class="message"><?= htmlspecialchars($msg); ?></div>
        <form method="POST">
            <label for="nome">Nome do Quarto:</label>
            <input type="text" id="nome" name="nome" required>
            <button type="submit" class="btn">Excluir Quarto</button>
        </form>
    </div>
</body>
</html>