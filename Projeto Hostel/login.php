<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostelalmeidao";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$email = $_POST['email'] ?? null;
$senha = $_POST['senha'] ?? null;

if ($email && $senha) {
    $sql = "SELECT * FROM Login WHERE Email = ? AND ADM = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if ($senha === $row['Senha']) {
            header("Location: adm/menuadm.html");
            exit();
        } else {
            echo "Senha inválida.";
        }
    } else {
        echo "Email não encontrado ou acesso não autorizado.";
    }

    $stmt->close();
} else {
    echo "Por favor, preencha todos os campos.";
}

$conn->close();
?>
