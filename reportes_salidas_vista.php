<?php 
require("coneccion/connection.php");
session_start();

// Si se cerro la sesión por otro lado
$definido=isset($_SESSION['usuario']);
// No está definido la variable
if ($definido==false){

    header("Location:error1.php");
    exit();
         
}

if(isset($_GET['fecha_inicial'])) {

    $fecha_inicial=$_GET['fecha_inicial'];
    $fecha_final=$_GET['fecha_final'];
   
}

/*
$valores_fecha_inicial[2], año
$valores_fecha_inicial[1], mes
$valores_fecha_inicial[0], dia
*/

$valores_fecha_inicial = explode('-', $fecha_inicial);
$fecha_inicial_b=$valores_fecha_inicial[2]."/".$valores_fecha_inicial[1]."/".$valores_fecha_inicial[0];

$valores_fecha_final = explode('-', $fecha_final);
$fecha_final_b=$valores_fecha_final[2]."/".$valores_fecha_final[1]."/".$valores_fecha_final[0];

// Comprobantes Dependencias fechas
$sql2="SELECT * FROM articulos_entregados ;
$sql2.= WHERE (fecha_envio BETWEEN '$fecha_inicial_b' AND '$fecha_final_b') AND (anulado = 'no')";

$query2 = $mysqli->query($sql2);

if($query2->num_rows==0){

  $_SESSION['contenido_mensaje_repor']='No hay comprobantes con esa fecha';
  $_SESSION['reporte_mensaje']='si';  
  echo "<script>location.href = 'reportes_salidas.php?fecha_inicial=$fecha_inicial&fecha_final=$fecha_final'</script>"; 
  exit();

}

// Totaliza los renglones de la factura segun la cantidad del producto
$ii=0;
$sql3="SELECT id_articulo FROM comprobantes_reng
while ($row2=$query2->fetch_assoc()) {

  $ii=$ii+1;

  
  if($ii==1){

    $sql3.=WHERE (num_transferencia = $num_transferencia3) ;

  }

  if($ii>1){

    $sql3.= OR (num_transferencia = $num_transferencia3) ;

  }

}

$sql3.=GROUP BY id_articulo";

$query3 = $mysqli->query($sql3);

if($query3->num_rows==0){

  $_SESSION['contenido_mensaje_repor']='Comprobante no tiene renglones';
  $_SESSION['reporte_mensaje']='si';  
  echo "<script>location.href = 'reportes_salidas.php?fecha_inicial=$fecha_inicial&fecha_final=$fecha_final'</script>"; 
  exit();

}

// Lista los totales de las cantidades de articulos
$i=0;
while ($row3=$query3->fetch_assoc()) {

  //echo $row3['id_articulo'];
  //echo "---";
  //echo $row3['total'];
  //echo "---";

  $i=$i+1;
  $id_articulo_4=$row3['id_articulo'];

  $sql4="SELECT 'nombre_articulo', id_subrubro ; 
  $sql4.=FROM articulos WHERE (id_articulo = $id_articulo_4)";

  $query4 = $mysqli->query($sql4);

  if($query4->num_rows==0){

    $_SESSION['contenido_mensaje_repor']='El nombre del articulo no se encuentra';
    $_SESSION['reporte_mensaje']='si';  
    echo "<script>location.href = 'reportes_salidas.php?fecha_inicial=$fecha_inicial&fecha_final=$fecha_final'</script>"; 
    exit();

  }

  $row4=$query4->fetch_assoc();

  if ($i==1){
      
    $nombre_articulos_a = array(

      $i => array(
        
        'nombre_articulo' => $row4['nombre_articulo'],
        'id_subrubro' => $row4['id_subrubro'],
        'cantidad_p' => $row3['cantidad_total'],
        'marca' => $row3['marca'],
        'modelo' => $row3['modelo'],
        
        
      ),
  
    );

  }

  if ($i>1){

    array_push($nombre_articulos_a, 

      array(

        'nombre_articulo' => $row4['nombre_articulo'],
        'id_subrubro' => $row4['id_subrubro'],
        'cantidad_p' => $row3['cantidad_total'],
        'marca' => $row3['marca'],
        'modelo' => $row3['modelo'],
        

      )

    );

  }

}

//print_r($productos_a);
//echo "----";
//exit();

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
<title>Dir. de Arquitectura - Reporte - Ventas</title>

<link rel="stylesheet" href="demo/libs/bundled.css">
<script src="demo/libs/bundled.js"></script>
<script src="js/jquery-latest.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery-confirm.css"/>
<script type="text/javascript" src="js/jquery-confirm.js"></script>

<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script src="bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="fonts/style.css">

<link rel="shortcut icon" href="imagen/avatar.png" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

<style type="text/css">
  
  .productodato{

    font-size:16px; 
    text-align:right;
    
  }
   .fecha_rep{

    font-size:16px; 

  }

  @media screen and (max-width:400px ) {

  .productodato{

    font-size:14px; 
    
  }
  .fecha_rep{

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

    <img src='imagen/IniPoderJUdicialCtes.jpg' alt='logo venezon' width='50%' height='auto'>
    <h3>Reporte - Ventas - Productos</h3>
    <p class="fecha_rep"><b>Fecha Inicial: </b><?php echo $fecha_inicial; ?>
    <br/><b>Fecha Final: </b><?php echo $fecha_final; ?>
    <br/>
    <b>Moneda:</b> <?php echo $_SESSION['moneda_base']; ?>
    </p>

  </div>

</div>  

<div class="table-responsive">

<div class="table-responsive">

<table class="table table-bordered">
  
 <thead>
  <tr>
    
    <th class='table-header' width='5%'>id_articulo</th>
    <th class='table-header' width='25%'>nombre_articulo</th>
    <th class='table-header' width='30%'>id_subrubro</th>
    <th class='table-header' width='10%'>id_rubro</th>
    <th class='table-header' width='10%'>marca</th>
    <th class='table-header' width='10%'>modelo</th>
    <th class='table-header' width='10%'>estado</th>
        
  </tr>
  </thead>

   <tbody id='table-body'>

    
    </tbody>

</table>

  <div class="productodato">
   <?php

      echo "<b>Total enviado: </b>".number_format($total_enviado,2,',','.');
      echo "<br/>";
      

    ?>
  </div>  

</div>  

</div>

<br/>

<div class="form-horizontal">

  <div class="form-group">

    <div class="usuario3">
    <a id="menu" href="panel.php">Menu</a>
    <a id="volver" href="reportes_salidas.php?fecha_inicial=<?php echo $fecha_inicial; ?>&fecha_final=<?php echo $fecha_final; ?>">Volver</a>
    <a href="#" id="Imprimir" onclick="printe()">Imprimir</a> 
    </div>

  </div> <!-- class="form-group" -->  

</div>

</div> <!-- class="container" -->		
</body>
</html>