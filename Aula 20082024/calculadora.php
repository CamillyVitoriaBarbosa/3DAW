<?php
$v1 = $_GET["a"];
$op = $_GET["op"];
$v2 = $_GET["b"];
    if ($op = "+"){
        $result = $v1 + $v2;
    }
    else if ($op = "-"){
        $result = $v1 - $v2;
    }
    else if ($op = "x"){
        $result = $v1 * $v2;
    }
    else{
        $result = $v1 / $v2;
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