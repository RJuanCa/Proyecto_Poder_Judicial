<?php 
require("coneccion/connection.php");
session_start();


Nota:
echo $_SESSION['productos2'][1]['id_producto'];
exit();


// Si se cerro la sesión por otro lado
$definido=isset($_SESSION['usuario']);
// No está definido la variable
if ($definido==false){

    header("Location:error1.php");
    exit();
         
}

if(isset($_GET['num_transferencia'])){

	$num_transferencia=$_GET['num_transferencia'];	
	$id_articulo=$_GET['id_articulo'];
	$id_rubro=$_GET['id_rubro'];
	$id_subrubro=$_GET['id_subrubro'];
	$marca=$_GET['marca'];
	$id_dep=$_GET['id_dep'];
	$responsable_dep=$_GET['responsable_dep'];
	$cantidad=$_GET['cantidad'];
	$id_usuario=$_GET['id_usuario'];
	$fecha_envio=$_GET['fecha_envio'];

	$_SESSION['num_transferencia_rep']=$num_transferencia;
	$_SESSION['id_articulo_rep']=$id_articulo;
	$_SESSION['id_rubro_rep']=$id_rubro;
	$_SESSION['id_subrubro']=$id_subrubro;
	$_SESSION['marca']=$marca;
	$_SESSION['id_dep']=$id_dep;
	$_SESSION['responsable_dep']=$responsable_dep;
	$_SESSION['cantidad']=$cantidad;
	$_SESSION['id_usuario']=$id_usuario;
	$_SESSION['fecha_envio']=$fecha_envio;

	$sql="SELECT articulos_entrgados.num_transferencia, articulos_entrgados.id_articulo,;
  	$sql.=articulos_entrgados.id_rubro, articulos_entrgados.id_producto, ;
  	$sql.=articulos.producto, articulos.descripcion, ;
  	$sql.=articulos_entrgados.cantidad, articulos_entrgados.precio_unitario, ;
  	$sql.=articulos_entrgados.precio_total FROM articulos ;
    $sql.=INNER JOIN articulos_entrgados ON (articulos.id_producto = articulos_entrgados.id_producto) ;
	$sql.=WHERE (articulos_entrgados.num_transferencia = ".$num_transferencia.") ;
	$sql.=ORDER BY articulos_entrgados.id_rubro";

	$row = $mysqli->query($sql);
	//$fila = $row->fetch_assoc();

	$total_renglones=$row->num_rows;
	$_SESSION['total_renglones_rep']=$total_renglones;

	
} // if(isset($_GET['num_transferencia']))

?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title>Venezon - Factura - Vista</title>

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
  .usuario3 {

	color:black;
	font-size:16px;
	
  }
  .total_factura{

  	text-align:right;
  	font-size:16px;

  }

  .cantidad{

  	width:65px;
  	text-align:center;

  }

  .monto{

	text-align:right;  	

  }

  #pass{

  	width:120px;
  	height: 25px;

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
  document.getElementById("formulario_moneda").style.display='inline';

}
</script>

</head>

<body>

<div class="container">

<br/>

<div>

<div align ="right" style="float:right;">

<img src='imagen/imgvenezon3.jpg' alt='logo venezon' width='50%' height='auto'>

</div>

<div>

<p class="usuario3">

	<b>Factura Nro.:</b> <?php echo $id_articulo; ?>
	<br/>	
	Fecha Factura: <?php echo $id_rubro; ?>
	<br/>
	Cliente: <?php echo $_SESSION['cliente'] ; ?>
	<br/>
	Cédula o Rif: <?php echo $_SESSION['cedula']; ?>
	<br/>
	Teléfono: <?php echo $_SESSION['telefono']; ?>
	<br/>
	Moneda: <?php echo $_SESSION['moneda_base']; ?>
	<br/>
	
</p>

</div>

</div>

<div class="table-responsive">

<?php if(isset($_SESSION['productos2'])) { ?>

<form id="formulario_renglones" method="post" action="crear_factura.php">

<table class="table table-bordered">

  <thead>
	<tr>
	  
	  <th class='table-header' width='5%'>Id Artículo</th>
	  <th class='table-header' width='10%'>Id Rubro</th>
	  <th class='table-header' width='10%'>Id Subrubro</th>
	  <th class='table-header' width='10%'>Marca</th>
	  <th class='table-header' width='15%'>Id Dependencia</th>
	  <th class='table-header' width='15%'>Responsable</th>
	  <th class='table-header' width='10%'>Cantidad</th>
	  <th class='table-header' width='10%'>Fecha de Envío</th>
	  
	</tr>
  </thead>

  <tbody id='table-body'>
	
<?php

	//$totalprice=0;
	$nro_reng2=0;
	$cantidad2=0;
	
	for($i=0;$i<$total_renglones;$i++){

		$nro_reng2++;
		$nro_reglon=$nro_reng2;
		
		//$subtotal=$_SESSION['productos2'][$nro_reglon]['cantidad']*$_SESSION['productos2'][$nro_reglon]['precio'];
		//$totalprice+=$subtotal;

		$cantidad2+=$_SESSION['productos2'][$nro_reglon]['cantidad'];

?>

	<tr class='table-row'>
		  
		<td><?php echo $_SESSION['productos2'][$nro_reglon]['orden'] ?></td>
		<td><?php echo $_SESSION['productos2'][$nro_reglon]['producto'] ?></td>
		<td><?php echo $_SESSION['productos2'][$nro_reglon]['descripcion'] ?></td>
		<td><div class="cantidad"><?php echo $_SESSION['productos2'][$nro_reglon]['cantidad'] ?></div></td>
		<td><div class="monto"><?php echo number_format($_SESSION['productos2'][$nro_reglon]['precio'],2,',','.') ?></div></td>
		<td><div class="monto"><?php echo number_format($_SESSION['productos2'][$nro_reglon]['cantidad']*$_SESSION['productos2'][$nro_reglon]['precio'],2,',','.'); ?></div></td>
		
	</tr>

<?php

	} // for($i=0;$i<$_SESSION['total_productos'];$i++)

	//$_SESSION['totalprice']=$totalprice;

?>

  </tbody>
</table>

<div class="total_factura">

	<b>Dependencia</b>: <?php echo number_format($_SESSION['id_dep'],2,',','.'); ?>
	<br/>
	<b>marca</b>: <?php echo number_format($_SESSION['marca'],2,',','.'); ?>
	<br/>
	<b>feha</b>: <?php echo number_format($_SESSION['fecha_envio'],2,',','.'); ?>
	<br/>
	<b>Cantidad de artículos:</b> <?php echo number_format($cantidad2,0,',','.'); ?>
	
</div>

</form>

<?php 

} // if(isset($_SESSION['productos2']))

?>

</div> <?php // class="table-responsive" ?>


<div class="usuario3">
<a id="menu" href="panel.php">Menu</a>
<a id="volver" href="buscar_comprobante.php?id_dep=<?php echo $_SESSION['id_dep'] ?>">Volver</a>
<a href="#" id="Imprimir" onclick="printe()">Imprimir</a> 
</div>
<div id="resultado"></div>
</div>		
</body>
</html>