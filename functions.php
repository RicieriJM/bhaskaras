<?php
/*
function nulo_zero($a, $b, $c)
{
    if ($a == null || $b == null || $c == null) {
        echo '<br> Preencha os campos! <br>';
        exit();
    } else {
        if ($a == 0 || $b == 0) {
            echo '<br> Digite um valor diferente de 0 para "a" e "b"! <br>';
            exit();
        }
    }
}

function delta($a, $b, $c)
{
    $delta = ($b * $b) - ((4 * $a) * $c);
         
    if ($delta < 0) {
        echo '<br> Não há valores reais de "x"! <br>';
        exit();
            
    } else {
        if ($delta >= 0) {
            return $delta;
        }
    }
}

function x1($a, $b, $delta)
{
    $x1 = (-$b + sqrt($delta)) / (2 * $a);
    return $x1;
}

function x2($a, $b, $delta)
{
    if ($delta == 0) {
        $x2 = null;
        
        echo '<br> Há somente uma raiz resultante! <br>';

    } else {
        $x2 = (-$b - sqrt($delta)) / (2 * $a);
    }

    return $x2;
}


function persistir($a, $b, $c, $delta, $x1, $x2)
{ 
    $conexao = mysqli_connect('localhost', 'root', '', 'bhaskara');
    $sqlinsert = "insert into calculo values(0, '$a', '$b', '$c', '$delta','$x1', '$x2')";
    $resultado = @mysqli_query($conexao, $sqlinsert);

    if (!$resultado) {
        die('<br> Query Inválida: ' . @mysqli_error($conexao) . '<br>');
    } else {

    }

    mysqli_close($conexao);
}*/


function calc_delta($a_vlr, $b_vlr, $c_vlr)
{
  $delta_ret = ($b_vlr * $b_vlr) - (4 * $a_vlr * $c_vlr);

  return $delta_ret;
}

function calc_x1($a_vlr, $b_vlr, $delta_vlr)
{
  $x1_ret = (-$b_vlr + sqrt($delta_vlr)) / (2 * $a_vlr);

  return $x1_ret;
}

function calc_x2($a_vlr, $b_vlr, $delta_vlr)
{
  $x2_ret = (-$b_vlr - sqrt($delta_vlr)) / (2 * $a_vlr);

  return $x2_ret;
}

function calc_bhaskara($a_vlr, $b_vlr, $c_vlr)
{
  if($a_vlr == 0) {

    return NULL;
  }

  $ret = array();
  $ret['delta'] = calc_delta($a_vlr, $b_vlr, $c_vlr);

  if($ret['delta'] < 0)   {
      $ret['x1'] = NULL;
      $ret['x2'] = NULL;

      return $ret;
  } else if($ret['delta'] == 0) {
    $ret['x1'] = calc_x1($a_vlr, $b_vlr, $ret['delta']);
    $ret['x2'] = NULL;

    return $ret;
  } else {
    $ret['x1'] = calc_x1($a_vlr, $b_vlr, $ret['delta']);
    $ret['x2'] = calc_x2($a_vlr, $b_vlr, $ret['delta']);
  }

  $delta = $ret['delta'];
  $x1 = $ret['x1'];
  $x2 = $ret['x2'];

  connect_and_write_db($a_vlr, $b_vlr, $c_vlr, $delta, $x1, $x2);

  return $ret;
}

function get_insert_sql($a_vlr, $b_vlr, $c_vlr, $delta, $x1, $x2)
{
  $query = "insert into calculo (a, b, c, delta, x1, x2) values ('$a_vlr','$b_vlr','$c_vlr','$delta','$x1', '$x2')";
  
  return($query);
}

function connect_and_write_db($a_vlr, $b_vlr, $c_vlr, $delta, $x1, $x2)
{
  $conn = mysqli_connect('localhost', 'root', '', 'bhaskara');
  $query = get_insert_sql($a_vlr, $b_vlr, $c_vlr, $delta, $x1, $x2);
  $result = mysqli_query($conn, $query);

  return $result;
}

?>