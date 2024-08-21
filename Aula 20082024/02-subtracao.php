<?php
$v1 = $_GET["a"];
$v2 = $_GET["b"];

$result = $v1 - $v2;
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