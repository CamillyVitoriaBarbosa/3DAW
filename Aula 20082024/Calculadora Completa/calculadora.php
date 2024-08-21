<?php
$v1 = $_GET["valor1"];
$op = $_GET["operacao"];
$v2 = $_GET["valor2"];
$result = [];
  if ($op == "soma") {
    $result = $v1 + $v2;
  } else if ($op == "subtração") {
    $result = $v1 - $v2;
  } else if ($op == "multiplicação") {
    $result = $v1 * $v2;
  } else if ($op == "divisão") {
    if ($v2 != 0) {
        $result = $v1 / $v2;
    } else {
        $result = "Erro: Divisão por zero";
    }
  } else {
    $result = "Operação inválida";
  }
?>
  
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
    <?php echo"<h1>Resultado: $result</h1>" ?>
  </body>
</html>