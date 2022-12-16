<?php

sleep(1);

require("coneccion/connection.php");
session_start();

// Si se cerro la sesión por otro lado
$definido=isset($_SESSION['usuario']);
// No está definido la variable
if ($definido==false){

	header("Location:index.php");
	exit();         
}

$nom_depen=$_GET["nom_depen"];

// Elimina la dependencia si no tiene movimientos
$sql="SELECT movimiento FROM dependencia WHERE (nom_depen = ".$nom_depen.")";
$query=$mysqli->query($sql);
$row=$query->fetch_assoc();

if($query->num_rows==0){
	if ($row['movimiento']=="no") {

  		$sql1="DELETE FROM dependencia WHERE (nom_depen = $nom_depen)";
  		$query=$mysqli->query($sql1);
          
  		$_SESSION['dependencia_eliminado']="si";
  		echo '<script>location.href = "buscar_dependencias.php"</script>';

	}else{

  		$_SESSION['dependencia_tiene_comprobantes']="si";
  		echo "<script>location.href = 'buscar_dependencias.php'</script>";
	}
}

?>