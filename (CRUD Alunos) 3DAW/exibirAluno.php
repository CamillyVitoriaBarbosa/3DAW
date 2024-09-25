<?php
$arquivo = "alunos.txt";
$alunos = [];
$matriculaBuscada = '';
$msg = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (file_exists($arquivo)) {
        $arqDisc = fopen($arquivo, "r");
        if ($arqDisc) {
            while (($linha = fgets($arqDisc)) !== false) {
                $alunos[] = explode(";", trim($linha));
            }
            fclose($arqDisc);
        } else {
            echo "Erro ao abrir o arquivo.";
        }

        $matriculaBuscada = trim($_POST['matricula']);

        if ($matriculaBuscada) {
            $encontrada = false;
            foreach ($alunos as $aluno) {
                if (strcasecmp($aluno[0], $matriculaBuscada) == 0) {
                    $encontrada = true;
                    break;
                }
            }

            if (!$encontrada) {
                $msg = "Aluno não encontrado.";
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
    <title>Buscar Aluno</title>
</head>
<body>
    <a href="index.html" class="back-button">
        &#8592;
    </a>
    <div class="center-box">
        <div class="topic-header">
            <header>Buscar Aluno</header>
        </div>
        <form action="" method="POST" class="form">
            <label for="matricula">Matrícula do Aluno:</label>
            <input type="text" id="matricula" name="matricula" required>
            <br><br>
            <div class="form-footer">
                <input type="submit" class="btn" value="Buscar Aluno">
            </div>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Matrícula</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Data de Nascimento</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($matriculaBuscada) {
                    $encontrada = false;
                    foreach ($alunos as $aluno) {
                        if (strcasecmp($aluno[0], $matriculaBuscada) == 0) {
                            $encontrada = true;
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($aluno[0]) . "</td>";
                            echo "<td>" . htmlspecialchars($aluno[1]) . "</td>";
                            echo "<td>" . htmlspecialchars($aluno[2]) . "</td>";
                            echo "<td>" . htmlspecialchars($aluno[3]) . "</td>";
                            echo "</tr>";
                        }
                    }

                    if (!$encontrada) {
                        echo "<tr><td colspan='4'>$msg</td></tr>";
                    }
                }
                ?>
                <?php
                if ($_SERVER["REQUEST_METHOD"] === "POST" && !file_exists($arquivo)) {
                    echo "<tr><td colspan='4'>$msg</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
