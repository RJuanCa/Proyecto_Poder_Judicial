<?php 

require("coneccion/connection.php");
session_start();

// Si se cerro la sesión por otro lado
$definido=isset($_SESSION['usuario']);
// No está definido la variable
if ($definido==false){

    header("Location:index.php");
    exit();
         
}

?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title>Dir. de Arquitectura - Articulos - Lista</title>

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
  .th_color{

    background: #0a3172;

  }
  .navbar{

    background: blue;

  }
  .body1{

    background:silver;

  }
  .menu2{

    font-size:24px;
    color:black;

  }
  .encab{

    font-size:18px;

  }
  @media screen and (max-width:400px ) {

  .menu2{

    font-size:19px;
    color:black;

   }
   
  }   

</style>

</head>
<body class="body1">

<nav class="navbar navbar-default">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      
      <p class="navbar-brand"><span class="menu2">Dir. de Arquitectura</span></p> 
      <p class="navbar-brand"><span class="menu2"><a href="panel.php">Menú</a></span></p> 

  </div>
    
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>

<div class="container">

<p class="usuario3">

  <span class="encab">
  <span class="text-danger">
	 Fecha: <?php  echo $_SESSION['fecha'];  ?>
	 <br/>
	 Usuario: <?php echo $_SESSION['usuario']; ?>
	</span>	
  </span>

</p>

<h4>Artículos</h4>
<?php
$search_keyword = '';
  if(!empty($_POST['search']['keyword'])) {
    $search_keyword = $_POST['search']['keyword'];
  }?>
<form name='frmSearch' action='' method='post'>
<div style='text-align:right;margin:20px 0px;'>
<imput type='text' name='search[keyword]' value="<?php echo $search_keyword;?>"id='keyword' maxlength='25'>
<div class="row">
  <div class="col-lg-6"></div>
  <div class="col-lg-6">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Buscar..."  name='search[keyword]' value="<?php echo $search_keyword; ?>" id='keyword' maxlength='50'>
      <span class="input-group-btn">
        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
</div>
<div class="table-responsive">
<p><span class="encab"><a href="reporte_inventario_vista.php">Actualizar Artículo</a></span></p>
<table class="table table-bordered table-hover">


<div class="row">
<div class="col-md-12">


<div class="table-responsive">

<form id="formulario_usuarios" method="post" action="crear_factura.php">

<?php


$sql2="SELECT * FROM articulos ORDER BY id_articulo";
$query2 = $mysqli->query($sql2);

if($query2->num_rows==0){

		echo "No hay datos para mostrar";

}else{ // if($query2->num_rows==0)	
}

?>

<table class="table table-bordered table-hover">

  <thead>
	<tr class='th_color'>
	  
	  <th class='table-header' width='8%'>Id Articulo</th>
	  <th class='table-header' width='30%'>Nombre Artículo</th>
    <th class='table-header' width='8%'>Id Subrubro</th>
    <th class='table-header' width='8%'>Id Rubro</th>
	  <th class='table-header' width='8%'>Marca</th>
    <th class='table-header' width='8%'>Modelo</th>
    <th class='table-header' width='8%'>Estado</th>
    <th class='table-header' width='8%'>Existencia</th>
    <th class='table-header' width='30%'>Acción</th>
	
	</tr>
  </thead>

  <tbody id='table-body'>
	
<?php
	
	while ($row2=$query2->fetch_assoc()) {

?>

		<tr class='table-row'>
		  
			<td><?php echo utf8_decode($row2['id_articulo'])?></td>
			<td><?php echo $row2['nombre_articulo']?></td>
      <td><?php echo $row2['id_subrubro']?></td>
      <td><?php echo  utf8_decode($row2['id_rubro'])?></td>
      <td><?php echo  utf8_decode($row2['marca'])?></td>
      <td><?php echo  utf8_decode($row2['modelo'])?></td>
      <td><?php echo  utf8_decode($row2['estado'])?></td>
      <td><?php echo  utf8_decode($row2['cantidad_existencia'])?></td>
			<td>

        <a href="#" onclick="Validar3(<?php echo $row2['id_articulo']?>, '<?php echo $row2['nombre_articulo']?>', '<?php echo $row2['nombre_articulo']?>', '<?php echo $row2['id_rubro']?>', '<?php echo $row2['id_subrubro']?>')">Editar | </a>
        <a href="#" onclick="Validar4(<?php echo $row2['id_articulo']?>, '<?php echo $row2['nombre_articulo'] ?>')">Eliminar</a>

      </td>
		
		</tr>

<?php

	} // while ($row2=$query2->fetch_assoc())

?>

  </tbody>
</table>

<?php

 // if($query2->num_rows==0)

?>


</form>

<div id="resultado"></div>
<br/>

<script>

// Editar articulo
function Validar3(id_articulo,nombre_articulo,nombre_articulo,id_rubro,id_subrubro)
{

// confirmation
$.confirm({
title: 'Mensaje',
content: '¿Confirma en editar el articulo '+nombre_articulo+'?',
animation: 'scale',
closeAnimation: 'zoom',
buttons: {
    confirm: {
        text: 'Si',
        btnClass: 'btn-orange',

           action: function(){

	         window.location.href="articulos_editar.php?id_articulo="+id_articulo+"&nombre_articulo="+nombre_articulo+"&nombre_articulo="+nombre_articulo+"&id_rubro="+id_rubro+"&id_subrubro="+id_subrubro;
             
           } // action: function(){

    }, // confirm: {

    cancelar: function(){
              
    } // cancelar: function()
    
	} // buttons
  
}); // $.confirm

}

// Eliminar articulos
function Validar4(id_articulo,nombre_articulo)
{

$.confirm({
title: 'Mensaje',
content: '¿Confirma en eliminar <br/> el Articulo '+nombre_articulo+'?',
animation: 'scale',
closeAnimation: 'zoom',
buttons: {
    confirm: {
        text: 'Si',
        btnClass: 'btn-orange',

           action: function(){

           window.location.href="articulos_eliminar_validar.php?id_articulo="+id_articulo;           
             
           } // action: function(){

    }, // confirm: {

    cancelar: function(){
              
    } // cancelar: function()
    
  } // buttons
  
}); // $.confirm

}

</script>

</div> <?php // class="table-responsive" ?>

</div> <!-- div class="col-md-8" -->

</div> <!-- div class="row" -->

</div>	

<?php 

if ( isset($_SESSION['articulo_guardado']) && $_SESSION['articulo_guardado'] == "si" ) {

    unset($_SESSION['articulo_guardado']);
    
    echo "<script>

    $.confirm({
      title: 'Mensaje',
      content: '<span style=color:green>Datos guardado con éxito.</span>',
      autoClose: 'Cerrar|3000',
      buttons: {
          Cerrar: function () {
            
          }
      }
    
    });</script>";

}

if ( isset($_SESSION['articulo_eliminado']) && $_SESSION['articulo_eliminado'] == "si" ) {

    unset($_SESSION['articulo_eliminado']);
    
    echo "<script>

    $.confirm({
      title: 'Mensaje',
      content: '<span style=color:green>Articulo eliminado con éxito.</span>',
      autoClose: 'Cerrar|3000',
      buttons: {
          Cerrar: function () {
            
          }
      }
    
    });</script>";

}

if ( isset($_SESSION['articulo_tiene_comprobantes']) && $_SESSION['articulo_tiene_comprobantes'] == "si" ) {

    unset($_SESSION['articulo_tiene_comprobantes']);
    
    $articulo_npe=$_SESSION['articulo_npe'];

    echo "<script>

    $.confirm({
      title: 'Mensaje',
      content: '<span style=color:red>No se puede eliminar el Artículo $articulo_npe<br/>porque tiene comprobantes.</span>',
      autoClose: 'Cerrar|3000',
      buttons: {
          Cerrar: function () {
            
          }
      }
    
    });</script>";

}

?>

<div class="panel-footer">
  <div class="container">
    
  </div>
</div>
</body>
</html>