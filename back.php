<?php

include 'functions.php';

echo '<pre>';

$a1 = $_POST['a1'];
$b1 = $_POST['b1'];
$c1 = $_POST['c1'];
$a2 = $_POST['a2'];
$b2 = $_POST['b2'];
$c2 = $_POST['c2'];

$a_valores = array();
$b_valores = array();
$c_valores = array();

for ($i= $a1; $i <= $a2; $i++) {
  $a_valores[] = $i;
}

for ($i= $b1; $i <= $b2; $i++) {
  $b_valores[] = $i;
}

for ($i= $c1; $i <= $c2; $i++) {
  $c_valores[] = $i;
}

$resultados = array();

foreach ($a_valores as $chave_a => $valor_a) {
  foreach ($b_valores as $chave_b => $valor_b) {
    foreach ($c_valores as $chave_c => $valor_c) {
      $resultado_temp = calc_bhaskara($valor_a, $valor_b, $valor_c);
      if ($resultado_temp != NULL && $resultado_temp['x1'] != NULL && $resultado_temp['x2'] != NULL) {
      $resultados[] = $resultado_temp;
    }
  }
}
}

var_dump($resultados);

 ?>