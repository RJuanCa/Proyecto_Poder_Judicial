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

$id_articulo=$_GET["id_articulo"];

//echo $id_articulo;
//exit();

$sql="SELECT id_articulo, comprobantes FROM articulos WHERE (id_articulo = ".$id_articulo.")";

$query=$mysqli->query($sql);
$row = $query->fetch_assoc();

if ($query->num_rows!=0) {
	

	if($row['comprobantes']=='no'){

  		$sql="DELETE FROM articulos WHERE (id_articulo = ".$id_articulo.")";
  		$query=$mysqli->query($sql);
          
  		$_SESSION['producto_eliminado']="si";
  		echo '<script>location.href = "articulos.php"</script>';

  	}else{

  		$_SESSION['producto_tiene_factura']="si";
    	echo "<script>location.href = 'articulos.php'</script>";    

  	}	

}else{

    echo "<p style='font-family: Arial; font-size: 11pt; color: red'>Artículo no existe</p>";

}

?>