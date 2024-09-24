<?php
$arquivo = "perguntas.txt";
$perguntas = [];
$perguntaBuscada = '';
$msg = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (file_exists($arquivo)) {
        $arqDisc = fopen($arquivo, "r");
        if ($arqDisc) {
            while (($linha = fgets($arqDisc)) !== false) {
                $perguntas[] = explode(";", trim($linha));
            }
            fclose($arqDisc);
        } else {
            echo "Erro ao abrir o arquivo.";
        }
        
        $perguntaBuscada = trim($_POST['pergunta']);
        
        if ($perguntaBuscada) {
            $encontrada = false;
            foreach ($perguntas as $pergunta) {
                if (strcasecmp($pergunta[0], $perguntaBuscada) == 0) {
                    $encontrada = true;
                    break;
                }
            }

            if (!$encontrada) {
                $msg = "Pergunta não encontrada.";
            }
        }
    } else {
        $msg = "Arquivo não encontrado.";
    }
}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Buscar Pergunta</title>
</head>
<body>
    <a href="menuPergunta.html" class="back-button">
        &#8592;
    </a>
    <div class="center-box">
        <div class="topic-header">
            <header>Buscar Pergunta</header>
        </div>
        <form action="" method="POST" class="form">
            <label for="pergunta">Id da Pergunta:</label>
            <input type="text" id="pergunta" name="pergunta" required>
            <br><br>
            <div class="form-footer">
                <input type="submit" class="btn" value="Buscar Pergunta">
            </div>
        </form>
    
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
                <?php
                if ($perguntaBuscada) {
                $encontrada = false;
                    foreach ($perguntas as $pergunta) {
                        if (strcasecmp($pergunta[0], $perguntaBuscada) == 0) {
                            $encontrada = true;
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($disciplina[0]) . "</td>";
                            echo "<td>" . htmlspecialchars($disciplina[1]) . "</td>";
                            echo "<td>" . htmlspecialchars($disciplina[2]) . "</td>";
                            echo "<td>" . htmlspecialchars($disciplina[3]) . "</td>";
                            echo "<td>" . htmlspecialchars($disciplina[4]) . "</td>";
                            echo "<td>" . htmlspecialchars($disciplina[5]) . "</td>";
                            echo "<td>" . htmlspecialchars($disciplina[6]) . "</td>";
                            echo "</tr>";
                        }
                    }
                    
                    if (!$encontrada) {
                        echo "<tr><td colspan='3'>$msg</td></tr>";
                    }
                }
                ?>
                <?php
                if ($_SERVER["REQUEST_METHOD"] === "POST" && !file_exists($arquivo)) {
                    echo "<tr><td colspan='3'>$msg</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>