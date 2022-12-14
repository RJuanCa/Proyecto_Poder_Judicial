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

/*
Nota:
echo $_SESSION['carrito'][1]['nombre_articulo'];
exit();
*/

if(isset($_GET['existencia'])) {

	$existencia=$_GET['existencia'];

	if ($existencia!=0){

		$hayexistencia="si";
	}else{

		$hayexistencia="no";
		$articulo_e=$_GET['id_articulo'];
	}
}
/*
if(!isset($_SESSION['total_productos'])) {

	$_SESSION['total_productos']=0;

}	
*/
// Eliminar articulo 
if(isset($_GET['orden'])) {

	$orden=$_GET['orden'];

	if($_SESSION['total_articulos']==1){

		if(isset($_SESSION['carrito'][1]['orden'])) {

			$_SESSION['total_articulos']--;	
			unset($_SESSION['carrito']);
		}
	}

	if($_SESSION['total_articulos']!=1){
		
		if(isset($_SESSION['carrito'][$_SESSION['total_articulos']]['orden'])) {

			if($orden==$_SESSION['carrito'][$_SESSION['total_articulos']]['orden']){

				$_SESSION['total_articulos']--;	
				unset($_SESSION['carrito'][$orden]);
			}else{ // if($orden==$_SESSION['carrito'][$_SESSION['total_articulos']]['orden'])

				for($i=$orden;$i<=$_SESSION['total_articulos'];$i++){

					if($_SESSION['total_articulos']!=$i){ 

						$_SESSION['carrito'][$i]['id_articulo']  	= $_SESSION['carrito'][$i+1]['id_articulo'];
						$_SESSION['carrito'][$i]['cantidad']	    = $_SESSION['carrito'][$i+1]['cantidad'];
						$_SESSION['carrito'][$i]['nombre_articulo']	= $_SESSION['carrito'][$i+1]['nombre_articulo'];
						$_SESSION['carrito'][$i]['id_subrubro']	    = $_SESSION['carrito'][$i+1]['id_subrubro'];
						$_SESSION['carrito'][$i]['id_rubro']	    = $_SESSION['carrito'][$i+1]['id_rubro'];
						$_SESSION['carrito'][$i]['orden']	        = $_SESSION['carrito'][$i]['orden'];
					}else{ // if($_SESSION['total_articulos']!=$i)

						$_SESSION['total_articulos']--;	
						unset($_SESSION['carrito'][$i]);
					} // if($_SESSION['total_articulos']!=$i)	

				} // for($i=$orden;$i<=$_SESSION['total_articulos'];$i++)
					
			} // if($orden==$_SESSION['carrito'][$_SESSION['total_articulos']]['orden'])

		} // if(isset($_SESSION['carrito'][$_SESSION['total_articulos']]['orden']))

	} // if($_SESSION['total_articulos']!=1)

} // if(isset($_GET['orden']))

$articulo_agregado='no';
$articulo_mensaje='no';

// agregar articulo
if(isset($_GET['id_articulo'])) {

	// id del articulo
	$id_articulo=$_GET['id_articulo'];
	$nombre_articulo=$_GET['nombre_articulo'];
	$id_subrubro=$_GET['id_subrubro'];
	$id_rubro=$_GET['id_rubro'];
	
	if ($hayexistencia=="si"){

		if(isset($_SESSION['carrito'])) {

			for($i=1;$i<=$_SESSION['total_articulos'];$i++){

				if($_SESSION['carrito'][$i]['id_articulo']==$id_articulo) {

					$ii=$i;
					// echo "<script>alert('articulo ya agregado en reglon nro.:".$i."')</script>";
					$articulo_agregado='si';
					$articulo_mensaje='si';
				}		
			} // for($i=1;$i<=$_SESSION['total_articulos'];$i++)

		} // if(isset($_SESSION['carrito']))

	}

	if($articulo_agregado=='no' && $hayexistencia=="si"){

		$_SESSION['total_articulos']++;	

		$_SESSION['carrito'][$_SESSION['total_articulos']]=array(

			"id_articulo" => $id_articulo,
			"cantidad" => "",
			"nombre_articulo" => $nombre_articulo,
			"id_subrubro" => $id_subrubro,
			"id_rubro" => $id_rubro,
			"orden"  => $_SESSION['total_articulos']

		);	
	} // if($articulo_agregado=='no')	

} // isset($_GET['id_articulo'])

// Boton guardar
if(isset($_POST['submit2'])){

	$_SESSION['guardar']="si";

	$k8['entro'][0]=0;
	$kk8=0;
	foreach($_POST['cantidad'] as $key => $val) {

		$kk8=$kk8+1;
		$k8['entro'][$kk8]=0;

		if ($val==0){

			$val="";
		}

		if ($val<0){

			$val="";			
		}

		if (is_numeric($val)){	
		
    		$_SESSION['cantidad3'][$key]=$val;

			if($val!=$_SESSION['carrito'][$key]['cantidad']){

				$_SESSION['carrito'][$key]['cantidad']="";
				$_SESSION['nro_reglon3']=$key;

				$k8['entro'][$kk8]=1;
			}
		}else{

			$_SESSION['carrito'][$key]['cantidad']="";
			$_SESSION['nro_reglon3']=$key;

			$k8['entro'][$kk8]=1;
		}
	}

	$entro=0;
	foreach($k8['entro'] as $kkey => $vval) {

		if($vval==1){

			if($entro==0){
				$entro=$vval;
				$indicee=$kkey;
			}
		}
	}
//ver despues !=0 o ==0
	if($entro!=0){

		$_SESSION['reglon_actualizado']="no";
		$_SESSION['mensaje_no_actualizado']="El reglon nro. $indicee no se actualizó la Cantidad";

	}

	// echo $_SESSION['cantidad3'][2];
	
}

// Lo direcciona el boton guardar al presinar si
if(isset($_GET['guardar2'])){

	echo "<script>location.href = 'crear_comprobante_validar.php'</script>";
	
}

// Boton totalizar articulos
if(isset($_POST['submit'])){

	foreach($_POST['cantidad'] as $key => $val) {

		if ($val==0){

			$val="";			
		}

		if ($val<0){

			$val="";			
		}

		if (is_numeric($val)){

			$val=intval($val);

			$id_articulo_b=$_SESSION['carrito'][$key]['id_articulo'];

			// Buscar id_articulo
			$sql3="SELECT id_articulo, cantidad_existencia FROM articulos WHERE (id_articulo = ".$id_articulo_b.")";
			$query3=$mysqli->query($sql3);
			$row3=$query3->fetch_assoc();

			if($query3->num_rows==0){

    			$existencia_b=0;
			}else{

				$existencia_b=$row3["cantidad_existencia"];
			}

			if ($existencia_b<$val){

				$_SESSION['carrito'][$key]['cantidad']="";
				$hayexistencia_cant="no";
				$articulo_e=$_SESSION['carrito'][$key]['nombre_articulo'];
				$reglon_b=$_SESSION['carrito'][$key]['orden'];
			}else{

				$_SESSION['carrito'][$key]['cantidad']=$val;
			}
		}else{ // if (is_numeric($val))

			$_SESSION['carrito'][$key]['cantidad']="";
				
		} // if (is_numeric($val))
	
	} // foreach($_POST['cantidad'] as $key => $val)	
	
} // isset($_POST['submit'])

//ver aca tambien  si agrego BOTON VISTA MONEDA
?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title>Dir. de Arquitectura - Generar Comprobante </title>

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

  #cantidad{

  	width:65px;
  	height: 28px;
  	text-align:center;

  }

  #pass{

  	width:120px;
  	height: 25px;

  }
  .th_color{

  	background: green;

  }
  .navbar{

  	background: #0a3172;

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
      <p class="navbar-brand"><span class="menu2"><a href="buscar_comprobante.php?nom_depen=<?php echo $_SESSION['nom_depen'] ?>">Volver</a></span></p> 

  </div>
    
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>

<div class="container">

<p class="usuario3">

	<span class="encab">
	<span class="text-danger">
	Fecha: <?php echo $_SESSION['fecha']; ?>
	<br/>
	Usuario: <?php echo $_SESSION['usuario']; ?>
	</span>
	<br/>
	<b><i>Dependencia: </i></b> <?php echo $_SESSION['nom_depen']; ?>
	<br/>
	<b><i>Responsable:</i></b> <?php echo $_SESSION['responsable_dep']; ?>
	<br/>
	
	</span>
	
</p>

<h3>Generar Comprobante</h3>

<div class="table-responsive">

<p><a href="buscar_articulos.php"><span class="encab">Agregar Artículo</span></a></p>

<?php if(isset($_SESSION['carrito'])) { ?>

<form id="formulario_renglones" method="post" action="crear_comprobante.php">

<div class="table-responsive">

<table class="table table-bordered table-hover">

  <thead>
	<tr class='th_color'>
	  
	  <th class='table-header' width='15%'>Id Artículo</th>
	  <th class='table-header' width='27%'>Nombre Artículo</th>
	  <th class='table-header' width='32%'>Id Subrubro</th>
	  <th class='table-header' width='32%'>Id Rubro</th>
	  <th class='table-header' width='10%'>Cantidad</th>
	  <th class='table-header' width='16%'>Enlace</th>

	</tr>
  </thead>

  <tbody id='table-body'>
	
<?php

	
	$nro_reng2=0;
	$cantidad2=0;
	
	for($i=0;$i<$_SESSION['total_articulos'];$i++){

		$nro_reng2++;
		$nro_reglon=$nro_reng2;

		//$cantidad2+=$_SESSION['carrito'][$nro_reglon]['cantidad'];
?>

	<tr class='table-row'>
		  
		<td><?php echo $_SESSION['carrito'][$nro_reglon]['id_articulo'] ?></td>
		<td><?php echo $_SESSION['carrito'][$nro_reglon]['nombre_articulo'] ?></td>
		<td><?php echo $_SESSION['carrito'][$nro_reglon]['id_subrubro'] ?></td>
		<td><?php echo $_SESSION['carrito'][$nro_reglon]['id_rubro'] ?></td>

		<td align="center"><input class="form-control" id="cantidad" type="text" name="cantidad[<?php echo $nro_reglon ?>]" size="6" maxlength="6" value="<?php echo $_SESSION['carrito'][$nro_reglon]['cantidad'] ?>"></td>
		<td><a href="#" onclick="Validar3(<?php echo $_SESSION['carrito'][$nro_reglon]['orden']?>)">Eliminar</a></td>

	</tr>

<?php

	}  for($i=0;$i<$_SESSION['total_articulos'];$i++)

	
	

?>

  </tbody>
</table>

</div>

<br/><br/>
	<div align="right">
	<b>Nro. de Artículos: </b> <?php echo number_format($cantidad2,0,',','.'); ?>
	</div>

</div>

<button class="btn btn-xs btn-success" type="submit" name="submit2" style="font-family: Arial; font-size: 12pt;"><b>Guardar</b></button>
<br/>
<br/>


</form>

<?php 

}  if(isset($_SESSION['carrito']))

?>

<div id="resultado"></div>
<br/>

<script>

// Eliminar articulo
function Validar3(pass)
{

// Nro. de reglon
var pass2=pass; 

// confirmation
$.confirm({
title: 'Mensaje',
content: '¿Confirma en eliminar el reglon nro.'+pass2+'?',
animation: 'scale',
closeAnimation: 'zoom',
buttons: {
    confirm: {
    	text: 'Si',
        btnClass: 'btn-blue',

           action: function(){

	         window.location.href="crear_comprobante.php?orden="+pass2;				     
             
           } // action: function(){

    }, // confirm: {

    cancelar: function(){
              
    } // cancelar: function()
    
	} // buttons
  
}); // $.confirm

}

</script>

</div> <?php // class="table-responsive" ?>

</div>	

<?php 

    if ( $articulo_mensaje == "si" ) {

    	$articulo_mensaje='no';
    	echo "<script>
    		
    		$.alert({

                title: 'Mensaje',
                content: '<span style=color:red>articulo ya agregado en reglon nro.:$ii.</span>',
                animation: 'scale',
                closeAnimation: 'scale',
                buttons: {
                	okay: {
                   		text: 'Cerrar',
                   		btnClass: 'btn-warning'
                	}
                }
            });

    	</script>";

    }

    if ( isset($_SESSION['cantidad_nulo']) && $_SESSION['cantidad_nulo'] == "si" ) {

    	$nro_reglon_nulo=$_SESSION['nro_reglon_nulo'];
		unset($_SESSION['cantidad_nulo']);
		unset($_SESSION['nro_reglon_nulo']);

        echo "<script>
    		
    		$.alert({

            	title: 'Mensaje',
            	content: '<span style=color:red>Debes introducir la cantidad <br/> en el reglon nro.: $nro_reglon_nulo.</span>',
            	animation: 'scale',
            	closeAnimation: 'scale',
            	buttons: {
            		okay: {
               			text: 'Cerrar',
               			btnClass: 'btn-warning'
            		}
            	}
       		});	

    	</script>";

    }

    if (isset($hayexistencia) && $hayexistencia=="no") {

    	echo "<script>
    		
    		$.alert({

                title: 'Mensaje',
                content: '<span style=color:red>$articulo_e no tiene existencia</span>',
                animation: 'scale',
                closeAnimation: 'scale',
                buttons: {
                	okay: {
                   		text: 'Cerrar',
                   		btnClass: 'btn-warning'
                	}
                }
            });

    	</script>";

    }

    if (isset($hayexistencia_cant) && $hayexistencia_cant=="no") {

    	echo "<script>
    		
    		$.alert({

                title: 'Mensaje',
                content: '<span style=color:red>$articulo_e no tiene existencia para esa cantida</span>',
                animation: 'scale',
                closeAnimation: 'scale',
                buttons: {
                	okay: {
                   		text: 'Cerrar',
                   		btnClass: 'btn-warning'
                	}
                }
            });

    	</script>";

    }

    if (isset($_SESSION['hay_existencia_b']) && $_SESSION['hay_existencia_b']=="no") {

    	unset($_SESSION['hay_existencia_b']);
    	$orden_b=$_SESSION['orden_b'];

    	echo "<script>
    		
    		$.alert({

                title: 'Mensaje',
                content: '<span style=color:red>articulo del reglon nro. $orden_b <br/> no tiene existencia</span>',
                animation: 'scale',
                closeAnimation: 'scale',
                buttons: {
                	okay: {
                   		text: 'Cerrar',
                   		btnClass: 'btn-warning'
                	}
                }
            });

    	</script>";

    }

    // Boton Guardar
	if (isset($_SESSION['guardar']) && $_SESSION['guardar']=="si") {

    	unset($_SESSION['guardar']);

    	if (isset($_SESSION['reglon_actualizado']) && $_SESSION['reglon_actualizado']="no") {

		unset($_SESSION['reglon_actualizado']);
		$nro_reglon3=$_SESSION['nro_reglon3'];
		$mensaje_no_actualizado=$_SESSION['mensaje_no_actualizado'];

    	echo "<script>
    		
    		$.alert({

                title: 'Mensaje',
                content: '<span style=color:red>$mensaje_no_actualizado</span>',
                animation: 'scale',
                closeAnimation: 'scale',
                buttons: {
                	okay: {
                   		text: 'Cerrar',
                   		btnClass: 'btn-warning'
                	}
                }
            });

    	</script>";

    	}else{

			// confirmation para guardar
			echo "<script> 

				$.confirm({
					title: 'Mensaje',
					content: '¿Confirma en guardar?',
					animation: 'scale',
					closeAnimation: 'zoom',
					buttons: {
    					confirm: {
        				text: 'Si',
        				btnClass: 'btn-blue',
           				action: function(){

	          					location.href = 'crear_comprobante.php?guardar2=1';

       					} // action: function(){

				}, // confirm: {

					cancelar: function(){
              
  						} // cancelar: function()
    
					} // buttons
  
				}); // $.confirm

			</script>";

		}

	}

	
?>

<div class="panel-footer">
  <div class="container">
   
  </div>
</div>

</body>
</html>