<?php
$arquivo = "disciplinas.txt";
$disciplinas = [];
$disciplinaBuscada = '';
$msg = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (file_exists($arquivo)) {
        $arqDisc = fopen($arquivo, "r");
        if ($arqDisc) {
            while (($linha = fgets($arqDisc)) !== false) {
                $disciplinas[] = explode(";", trim($linha));
            }
            fclose($arqDisc);
        } else {
            echo "Erro ao abrir o arquivo.";
        }
        
        $disciplinaBuscada = trim($_POST['disciplina']);
        
        if ($disciplinaBuscada) {
            $encontrada = false;
            foreach ($disciplinas as $disciplina) {
                if (strcasecmp($disciplina[0], $disciplinaBuscada) == 0) {
                    $encontrada = true;
                    break;
                }
            }

            if (!$encontrada) {
                $msg = "Disciplina não encontrada.";
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
    <title>Buscar Disciplina</title>
</head>
<body>
    <a href="index.html" class="back-button">
        &#8592;
    </a>
    <div class="center-box">
        <div class="topic-header">
            <header>Buscar Disciplina</header>
        </div>
        <form action="" method="POST" class="form">
            <label for="disciplina">Nome da Disciplina:</label>
            <input type="text" id="disciplina" name="disciplina" required>
            <br><br>
            <div class="form-footer">
                <input type="submit" class="btn" value="Buscar Disciplina">
            </div>
        </form>
    
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Sigla</th>
                    <th>Carga Horária</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($disciplinaBuscada) {
                $encontrada = false;
                    foreach ($disciplinas as $disciplina) {
                        if (strcasecmp($disciplina[0], $disciplinaBuscada) == 0) {
                            $encontrada = true;
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($disciplina[0]) . "</td>";
                            echo "<td>" . htmlspecialchars($disciplina[1]) . "</td>";
                            echo "<td>" . htmlspecialchars($disciplina[2]) . "</td>";
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
