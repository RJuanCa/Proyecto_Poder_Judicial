<?php  

sleep(1);

require("coneccion/connection.php");
session_start();

// Si se cerro la sesión por otro lado
$definido=isset($_SESSION['usuario']);
// No está definido la variable
if ($definido==false){

	header("Location:error1.php");
	exit();
         
}

$id_dependencia=$_GET["id_dependencia"];

// Elimina la dependencia si no tiene movimientos
$sql="SELECT movimiento FROM tab_dependencia WHERE (id_dependencia = ".$id_dependencia.")";
$query=$mysqli->query($sql);
$row=$query->fetch_assoc();

if($query->num_rows!=0){
	if ($row['movimiento']=="no") {

  		$sql="DELETE FROM tab_dependencia WHERE (id_dependencia = ".$id_dependencia.")";
  		$query=$mysqli->query($sql);
          
  		$_SESSION['cliente_eliminado']="si";
  		echo '<script>location.href = "buscar_clientes.php"</script>';

	}else{

  		$_SESSION['dependencia_tiene_comprobantes']="si";
  		echo "<script>location.href = 'buscar_dependencias.php'</script>";    

	}
}

?>