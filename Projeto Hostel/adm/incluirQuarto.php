<?php
require 'conexao.php';
$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $numeroCamas = filter_input(INPUT_POST, 'numero_camas', FILTER_VALIDATE_INT);
    $tipoCama = filter_input(INPUT_POST, 'tipo_cama', FILTER_SANITIZE_SPECIAL_CHARS);
    $preco = filter_input(INPUT_POST, 'preco', FILTER_VALIDATE_INT);
    $contem = filter_input(INPUT_POST, 'contem', FILTER_SANITIZE_SPECIAL_CHARS);

    if (!$nome || !$numeroCamas || !$tipoCama || !$preco || !$contem) {
        $msg = "Todos os campos são obrigatórios.";
    } else {
        try {
            $stmt = $pdo->prepare(
                "INSERT INTO Quartos (Nome, `Número de camas`, `Tipo de cama`, `Contém`, `Preço`) VALUES (?, ?, ?, ?, ?)"
            );
            $success = $stmt->execute([$nome, $numeroCamas, $tipoCama, $contem, $preco]);
            $msg = $success ? "Quarto incluído com sucesso!" : "Erro ao incluir quarto.";
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
    <title>Incluir Quarto</title>
</head>
<body>
    <a href="menuadm.html" class="back-button">&#8592;</a>
    <div class="center-box">
        <header class="topic-header">Incluir Quarto</header>
        <div class="message"><?= htmlspecialchars($msg); ?></div>
        <form method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
            <label for="numero_camas">Número de Camas:</label>
            <input type="number" id="numero_camas" name="numero_camas" required>
            <label for="tipo_cama">Tipo de Cama:</label>
            <input type="text" id="tipo_cama" name="tipo_cama" required>
            <label for="contem">Contém:</label>
            <textarea id="contem" name="contem" required></textarea>
            <label for="preco">Preço:</label>
            <input type="number" id="preco" name="preco" required>
            <button type="submit">Salvar</button>
        </form>
    </div>
</body>
</html>