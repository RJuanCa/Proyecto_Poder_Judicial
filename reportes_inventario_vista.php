<?php 

require("coneccion/connection.php");
session_start();

// Si se cerro la sesión por otro lado
$definido=isset($_SESSION['usuario']);
// No está definido la variable
if ($definido==false){

    header("Location:panel.php");
    exit();
         
}

// Totaliza los renglones del comprobante segun la cantidad del articulos
$sql3="SELECT id_articulo, nombre_articulo, id_subrubro, id_rubro, marca, modelo, estado, cantidad_art, cantidad_existencia FROM articulos GROUP BY id_articulo ";

$query3 = $mysqli->query($sql3);

if($query3->num_rows==0){

  echo "<p style='font-family: Arial; font-size: 11pt; color: red'>No hay productos</p>"; 
  exit();

}

// Lista los totales de las cantidades de los articulo
$i=0;
while ($row3=$query3->fetch_assoc()) {

  $i=$i+1;
  $id_producto=$row3['id_articulo'];

  if ($i==1){
      
    $id_articulo = array(

      $i => array(
        'id_articulo_p' => $row3['id_articulo'],        
        'nombre_articulo_p' => $row3['nombre_articulo'],
        'id_subrubro_p' => $row3['id_subrubro'],
        'id_rubro_p' => $row3['id_rubro'],
        'marca_p' => $row3['marca'],
        'modelo_p' => $row3['modelo'],
        'cantidad_existencia_p' => $row3['cantidad_existencia'],

      ),
  
    );

  }

  if ($i>1){

    array_push($id_articulo, 

      array(
        'id_articulo_p'=>$row3['id_articulo'],
        'nombre_articulo_p' => $row3['nombre_articulo'],
        'descripcion_p' => $row3['id_subrubro'],
        'id_rubro_p' => $row3['id_rubro'],
        'marca_p' => $row3['marca'],
        'modelo_p' => $row3['modelo'],
        'estado_p'=>$row3['estado'],
        'cantidad_existencia_p' => $row3['cantidad_existencia'],
       
      )

    );

  }

}

function array_sort($array, $on, $order=SORT_ASC)
{

    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title>Dir. de Arquitectura - Reporte - Artículos</title>

<link rel="stylesheet" href="demo/libs/bundled.css">
<script src="demo/libs/bundled.js"></script>
<script src="js/jquery-latest.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery-confirm.css"/>
<script type="text/javascript" src="js/jquery-confirm.js"></script>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script src="bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="fonts/style.css">
<link rel="shortcut icon" href="imagen/Logo-Poder-Judicial-Ctes.png" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

<style type="text/css">
  
  .productodato{

    font-size:16px; 
    text-align:right;
    
  }
  .cantidad{

    width:65px;
    text-align:center;

  }
  
  @media screen and (max-width:400px ) {

  .productodato{

    font-size:14px; 
    
  }
     
  }   
    
</style>

<script>
function printe(){
  //desaparece el boton
  document.getElementById("menu").style.display='none';
  document.getElementById("volver").style.display='none';
  document.getElementById("Imprimir").style.display='none';
  
  //se imprime la pagina
  window.print();
  //reaparece el boton
  document.getElementById("menu").style.display='inline';
  document.getElementById("volver").style.display='inline';
  document.getElementById("Imprimir").style.display='inline';
  
}
</script>

</head>

<body>

<div class="container">

<br/>

<div class="form-horizontal">

  <div class="form-group">

    <img src='imagen/logoPoderJud150x550.png' alt='logo venezon' width='50%' height='auto'>
    <h3>Reporte - Artículos</h3>
    
    </p>

  </div>

</div>  

<div class="table-responsive">

<div class="table-responsive">

<table class="table table-bordered">
  
 <thead>
  <tr>
    
    <th class='table-header' width='15%' style="vertical-align:middle">Id Artículo</th>
    <th class='table-header' width='40%' style="vertical-align:middle">Nombre Articulo</th>
    <th class='table-header' width='15%' style="vertical-align:middle">Id Subrubro</th>
    <th class='table-header' width='15%' style="vertical-align:middle">Id Rubro</th>
    <th class='table-header' width='35%' style="vertical-align:middle">Marca</th>
    <th class='table-header' width='35%' style="vertical-align:middle">Modelo</th>
    <th class='table-header' width='25%' style="vertical-align:middle">Estado</th>
    <th class='table-header' width='10%' style="vertical-align:middle">Existencia</th>
            
  </tr>
  </thead>

   <tbody id='table-body'>

    <?php

      $new_array_2 = array();
      $new_array_2 = array_sort($id_articulo, 'id_articulo_p', SORT_ASC);

      $total_enviado = 0;
      $nro_pp=0;
      $pp1=0;
      $pp2=0;
      $pp3=0;
      $pp4=0;
      $pp5=0;
      $pp6=0;
      $pp7=0;
      $pp8=0;
      foreach ($new_array_2 as $id_articulo=> $a){
        $p="";
        foreach($a as $b=>$c){
          $p .="|||" . $c;
        }
        $nro_pp=$nro_pp;
        $pp=explode("|||", $p);

        //Total cantidad
         /*$pp6=$pp6+$pp[6]; */
        ?>
        <tr class="table-row">
          <td><?php echo utf8_decode($pp[1]);?></td>
          <td><?php echo utf8_decode($pp[2]);?></td>
          <td><?php echo utf8_decode($pp[3]);?></td>
          <td><?php echo utf8_decode($pp[4]);?></td>
          <td><?php echo utf8_decode($pp[5]);?></td>
          <td><?php echo utf8_decode($pp[6]);?></td>
          <td><?php echo utf8_decode($pp[7]);?></td>
          <td><div class="cantidad"><?php echo $pp[0];?></div></td>
          
        </tr>
      <?php
      }
      ?>

      
    
    <?php

      
    ?>

   </tbody>

</table>
  
</div>  

</div>

<br/>

<div class="form-horizontal">

  <div class="form-group">

    <div class="usuario3">
    <a id="menu" href="panel.php">Menú |</a>
    <a id="volver" href="reportes.php"> Volver |</a>
    <a href="#" id="Imprimir" onclick="printe()"> Imprimir</a> 
    </div>

  </div> <!-- class="form-group" -->  

</div>

</div> <!-- class="container" -->		
</body>
</html>