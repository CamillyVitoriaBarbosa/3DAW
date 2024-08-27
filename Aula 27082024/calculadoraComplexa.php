<?php
$v = $_GET["valor"];
$op = $_GET["operacao"];
$result = [];
  if ($op == "raiz quadrada") {
    $result = sqrt($v);
  } else if ($op == "inversão do valor") {
    $result = ($v*-1);
  } else if ($op == "dividido por um") {
    if ($v != 0) {
        $result = (1/$v);
    } else {
        $result = "Erro: Divisão por zero";
    }
  } else if ($op == "seno") {
    $result = sin($v);
  } else if ($op == "cosseno") {
    $result = cos($v);
  } else if ($op == "tangente") {
    $result = tan($v);
  } else {
    $result = "Operação inválida";
  }
?>
  
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <?php echo"<h1>Resultado: $result</h1>" ?>
  </body>
</html>