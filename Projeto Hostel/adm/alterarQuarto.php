<?php
require 'conexao.php';
$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeNovo = filter_input(INPUT_POST, 'nomeNovo', FILTER_SANITIZE_SPECIAL_CHARS);
    $nomeAntigo = filter_input(INPUT_POST, 'nomeAntigo', FILTER_SANITIZE_SPECIAL_CHARS);
    $tipoCama = filter_input(INPUT_POST, 'tipoCama', FILTER_SANITIZE_SPECIAL_CHARS);
    $preco = filter_input(INPUT_POST, 'preco', FILTER_VALIDATE_INT);
    $numeroCamas = filter_input(INPUT_POST, 'numeroCamas', FILTER_VALIDATE_INT);
    $contem = filter_input(INPUT_POST, 'contem', FILTER_SANITIZE_SPECIAL_CHARS);

    if (!$nomeNovo || !$nomeAntigo || !$tipoCama || !$preco || !$numeroCamas) {
        $msg = "Todos os campos são obrigatórios.";
    } else {
        try {
            $stmt = $pdo->prepare(
                "UPDATE Quartos SET Nome = ?, `Número de camas` = ?, `Tipo de cama` = ?, `Contém` = ?, `Preço` = ? WHERE Nome = ?"
            );
            $success = $stmt->execute([$nomeNovo, $numeroCamas, $tipoCama, $contem, $preco, $nomeAntigo]);
            $msg = $success ? "Quarto atualizado com sucesso!" : "Erro ao atualizar quarto.";
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
    <title>Alterar Quarto</title>
</head>
<body>
    <a href="menuadm.html" class="back-button">&#8592;</a>
    <div class="center-box">
        <header class="topic-header">Alterar Quarto</header>
        <div class="message" id="msg"><?= htmlspecialchars($msg); ?></div>
        <form method="POST">
            <label for="nomeAntigo">Nome do Quarto a alterar:</label>
            <input type="text" id="nomeAntigo" name="nomeAntigo" required>
            <label for="nomeNovo">Novo Nome:</label>
            <input type="text" id="nomeNovo" name="nomeNovo">
            <label for="numeroCamas">Número de Camas:</label>
            <input type="number" id="numeroCamas" name="numeroCamas">
            <label for="tipoCama">Tipo de Cama:</label>
            <input type="text" id="tipoCama" name="tipoCama">
            <label for="contem">Contém:</label>
            <textarea id="contem" name="contem"></textarea>
            <label for="preco">Preço:</label>
            <input type="number" id="preco" name="preco">
            <button type="submit" class="btn">Alterar Quarto</button>
        </form>
    </div>
</body>
</html>