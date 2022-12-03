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

//echo "Funciona ...";
//echo $_SESSION['cantidad3'][2];
//echo $_SESSION['orden3'];
//exit();

// Chequea si hay un valor vacio
for($i=1;$i<=$_SESSION['total_articulos'];$i++){

	if(empty($_SESSION['carrito'][$i]['cantidad'])){

		$_SESSION['nro_reglon_nulo']=$i;
		$_SESSION['cantidad_nulo']="si";

		//echo "<p style='font-family: Arial; font-size: 11pt; color: red'>Debes introducir la cantidad en el reglon nro.".$_SESSION['carrito'][$i]['orden']."</p>";

		echo "<script>location.href = 'crear_comprobante.php'</script>";
		exit();

	}
	
} // for($i=0;$i<$_SESSION['total_articulos'];$i++)

// Chequea si hay existencia
for($i=1;$i<=$_SESSION['total_articulos'];$i++){

	$id_articulo_b=$_SESSION['carrito'][$i]['id_articulo'];

	// Buscar id_articulo
	$sql3="SELECT id_articulo, cantidad_enviada, cantidad_existencia FROM articulos WHERE (id_articulo = ".$id_articulo_b.")";
	$query3=$mysqli->query($sql3);
	$row3=$query3->fetch_assoc();

	if($query3->num_rows==0){

    	$existencia_b=0;

	}else{

		$existencia_b=$row3["cantidad_existencia"];
		$nor_env_b=$row3["cantidad_env"];

	}	

	//echo $_SESSION['carrito'][$i]['orden'];
	//exit();

	if($_SESSION['carrito'][$i]['cantidad']>$existencia_b){

		$_SESSION['hay_existencia_b']="no";
		$_SESSION['orden_b']=$_SESSION['carrito'][$i]['orden'];
				
		echo "<script>location.href = 'crear_comprobante.php'</script>";
		exit();

	}else{

		$existencia_bd=$existencia_b-$_SESSION['carrito'][$i]['cantidad'];
		$nor_env_bd=$nor_env_b+$_SESSION['carrito'][$i]['cantidad'];

		// Guarda datos 
		$sql="UPDATE articulos SET cantidad_existencia = .$existencia_bd., cantidad_env = .$nor_env_bd. ;
		$sql.= WHERE (articulos.id_articulo = .$id_articulo_b.)";

		$query = $mysqli->query($sql);

	}
	
} // for($i=0;$i<$_SESSION['total_articulos'];$i++)

$total_articulos=0;
// Chequea totales
for($i=1;$i<=$_SESSION['total_articulos'];$i++){

	$total_articulos=$total_articulos+$_SESSION['carrito'][$i]['cantidad']*$_SESSION['carrito'][$i];
	
} // for($i=0;$i<$_SESSION['total_articulos'];$i++)

if($total_articulos!=$_SESSION['totalprice']){

	echo "<p style='font-family: Arial; font-size: 11pt; color: red'>Totales no coinciden</p>";
	exit();

}



$_SESSION['carrito'][$i]['precio'];
$_SESSION['carrito'][$i]['cantidad'];

$_SESSION['nom_depen'];
$_SESSION["id_usuario"];
$_SESSION['fecha'];
/*
$valores[0], año;
$valores[1], mes;
$valores[2], dia;

*/

$nom_depen=$_SESSION['nom_depen'];
$id_usuario=$_SESSION["id_usuario"];


$valores_fecha_act = explode('-', $_SESSION['fecha']);
$fecha_act=$valores_fecha_act[2]."-".$valores_fecha_act[1]."-".$valores_fecha_act[0];

$hora_actual=$_SESSION['hora_actual'];

$sql="SELECT * FROM tab_correlativos";
$query = $mysqli->query($sql);
$row=$query->fetch_assoc();

$nro_transferencia=$row["num_transferencia"];
$nro_transferencia_nuevo=$nro_transferencia+1;

// Guarda datos en la tabla comprobantes
$sql2="INSERT INTO comprobantes (num_transferencia,fecha_reg,id_dep,cantidad_enviada,id_usuario) ";
$sql2.="VALUES ('$nro_transferencia_nuevo','$fecha_act','$id_dep','$cantidad_enviada','$id_usuario')";
$query2=$mysqli->query($sql2);

// Buscar nro_comprobante
$sql3="SELECT  nro_transferencia FROM comprobantes WHERE (nro_transferencia = ".$nro_transferencia_nuevo.")";
$query3=$mysqli->query($sql3);
$row3=$query3->fetch_assoc();

// Guarda datos en tab_correlativos
$sql3="UPDATE tab_correlativos SET nro_transferencia=$nro_transferencia_nuevo";
$query3=$mysqli->query($sql3);      

$nro_transferencia=$row3["nro_transferencia"];

//Guarda datos en la tabla comprobantes_reng
for($i=1;$i<=$_SESSION['total_articulos'];$i++){

	$nro_renglon=$_SESSION['carrito'][$i]['orden'];
	$id_articulo=$_SESSION['carrito'][$i]['id_articulo'];
	$cantidad=$_SESSION['carrito'][$i]['cantidad'];
	$nom_depen=$_SESSION['carrito'][$i]['precio'];
	$responsable_dep=$_SESSION['carrito'][$i]['cantidad']*$_SESSION['carrito'][$i]['precio'];

	
	$sql4="SELECT nombre_articulo ; 
  	$sql4.=FROM articulos WHERE (id_articulo = $id_articulo)";

  	$query4 = $mysqli->query($sql4);
  	$row4=$query4->fetch_assoc();
  	

	$sql4="INSERT INTO comprobantes_reng (nro_transferencia,nro_reglon,id_articulo,cantidad,nom_depen,responsable_dep,direccion);
	$sql4.=VALUES ('$nro_transferencia','$nro_renglon','$id_articulo','$cantidad','$nom_depen','$responsable_dep','$direccion')";
	$query4=$mysqli->query($sql4);

} // for($i=1;$i<=$_SESSION['total_articulos'];$i++)

// Chequea si la dependencia tiene movimientos
$sql8="SELECT movimiento; 
$sql8.=FROM dependencia WHERE (id_dep = $id_dep)";

$query8 = $mysqli->query($sql8);
$row8=$query8->fetch_assoc();
$movimiento8=$row8['movimiento'];

if($movimiento8=='no'){

	$sql9="UPDATE dependencia SET movimiento = 'si' ";
	$sql9.="WHERE (dependencia.nom_depen = ".$nom_depen.")"; 

	$query9 = $mysqli->query($sql9);

}

$id_usuario_cp=$_SESSION["id_usuario"];

// Chequea si el usuario tiene movimientos
$sql8="SELECT movimiento ; 
$sql8.=FROM usuarios WHERE (id_usuario = $id_usuario_cp)";

$query8 = $mysqli->query($sql8);
$row8=$query8->fetch_assoc();
$movimiento8=$row8['movimiento'];

if($movimiento8=='no'){

    $sql9="UPDATE usuarios SET movimiento = 'si';
    $sql9.=WHERE (id_usuario = ".$id_usuario_cp.")"; 

    $query9 = $mysqli->query($sql9);

}

unset($_SESSION['carrito']);
unset($_SESSION['total_articulos']);
unset($_SESSION['direccion']);


// echo "<script>alert('comprobante registrada exitosamente.')</script>";

$_SESSION['comprobante_guardada']="si";
echo "<script>location.href = 'buscar_dependencias.php?id_dep=".$id_dep."'</script>";

?>