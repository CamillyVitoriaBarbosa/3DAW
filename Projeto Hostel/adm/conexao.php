<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=hostelalmeidao', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>
