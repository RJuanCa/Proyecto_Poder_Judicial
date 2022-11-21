<?php  

sleep(1);

require("coneccion/connection.php");
session_start();

// Si se cerro la sesión por otro lado
$definido=isset($_SESSION['usuario']);
// No está definido la variable
if ($definido==false){

	header("Location:panel.php");
	exit();
         
}

//validación
$error_form = "";

if ($_POST["nombre_articulo"] == "") {

	$_SESSION['contenido_mensaje_prod']='Debes escribir el nombre_articulo';
    $_SESSION['producto_mensaje']='si';
    $nombre_articulo="";
    $id_subrubro=$_POST["id_subrubro"];
    $id_rubro=$_POST["id_rubro"];
    $marca=$_POST["marca"];
    $modelo=$_POST["modelo"];
    $estado=$_POST["estado"];

    echo "<script>location.href = 'articulos_crear.php?nombre_articulo=$nombre_articulo&id_subrubro=$id_subrubro&id_rubro=$id_rubro&marca=$marca'</script>";    
	exit();

}else{

    $nombre_articulo=utf8_encode($_POST["nombre_articulo"]);

}

if ($_POST["id_subrubro"] == "") {

	$_SESSION['contenido_mensaje_prod']='Debes escribir la id_subrubro';
    $_SESSION['producto_mensaje']='si';
    $nombre_articulo=$_POST["nombre_articulo"];
    $id_subrubro="";
    $id_rubro=$_POST["id_rubro"];
    $marca=$_POST["marca"];
    $modelo=$_POST["modelo"];
    $estado=$_POST["estado"];


    echo "<script>location.href = 'articulos_crear.php?nombre_articulo=$nombre_articulo&id_subrubro=$id_subrubro&id_rubro=$id_rubro&marca=$marca'</script>";    
	exit();

}else{

    $id_subrubro=utf8_encode($_POST["id_subrubro"]);

}

if ($_POST["id_rubro"] == "") {

    $_SESSION['contenido_mensaje_prod']='Debes escribir el id_rubro';
    $_SESSION['producto_mensaje']='si';
    $nombre_articulo=$_POST["nombre_articulo"];
    $id_subrubro=$_POST["id_subrubro"];
    $id_rubro="";
    $marca=$_POST["marca"];
    $modelo=$_POST["modelo"];
    $estado=$_POST["estado"];


    echo "<script>location.href = 'articulos_crear.php?nombre_articulo=$nombre_articulo&id_subrubro=$id_subrubro&id_rubro=$id_rubro&marca=$marca'</script>";    
    exit();

}else{

    $id_rubro=utf8_encode($_POST["id_rubro"]);

}

if ($_POST["marca"] == "") {

    $_SESSION['contenido_mensaje_prod']='Debes escribir el Precio Final';
    $_SESSION['producto_mensaje']='si';
    $nombre_articulo=$_POST["nombre_articulo"];
    $id_subrubro=$_POST["id_subrubro"];
    $id_rubro=$_POST["id_rubro"];
    $marca="";
    $modelo=$_POST["modelo"];
    $estado=$_POST["estado"];


    echo "<script>location.href = 'articulos_crear.php?nombre_articulo=$nombre_articulo&id_subrubro=$id_subrubro&id_rubro=$id_rubro&marca=$marca'</script>";    
    exit();

}else{

    $marca=utf8_encode($_POST["marca"]);

}
if ($_POST["modelo"] == "") {

    $_SESSION['contenido_mensaje_prod']='Debes escribir el Precio Final';
    $_SESSION['producto_mensaje']='si';
    $nombre_articulo=$_POST["nombre_articulo"];
    $id_subrubro=$_POST["id_subrubro"];
    $id_rubro=$_POST["id_rubro"];
    $marca=$_POST["marca"];
    $modelo="";
    $estado=$_POST["estado"];


    echo "<script>location.href = 'articulos_crear.php?nombre_articulo=$nombre_articulo&id_subrubro=$id_subrubro&id_rubro=$id_rubro&marca=$marca'</script>";    
    exit();

}else{

    $modelo=utf8_encode($_POST["modelo"]);

}
if ($_POST["estado"] == "") {

    $_SESSION['contenido_mensaje_prod']='Debes escribir el estado';
    $_SESSION['producto_mensaje']='si';
    $nombre_articulo=$_POST["nombre_articulo"];
    $id_subrubro=$_POST["id_subrubro"];
    $id_rubro=$_POST["id_rubro"];
    $marca=["marca"];
    $modelo=$_POST["modelo"];
    $estado="";


    echo "<script>location.href = 'articulos_crear.php?nombre_articulo=$nombre_articulo&id_subrubro=$id_subrubro&id_rubro=$id_rubro&marca=$marca'</script>";    
    exit();

}else{

    $estado=utf8_encode($_POST["estado"]);

}

$estado = ($estado);


 exit();


    $nombre_articulo="";
    $id_subrubro=$_POST["id_subrubro"];
    $id_rubro=$_POST["id_rubro"];
    $marca=$_POST["marca"];
    $modelo=$_POST["modelo"];
    $estado=$_POST["estado"];


$valores_fecha_act = explode('-', $_SESSION['fecha']);
$fecha_act=$valores_fecha_act[2]."-".$valores_fecha_act[1]."-".$valores_fecha_act[0];
$hora_actual=$_SESSION['hora_actual'];


// Guarda datos 
$sql="INSERT INTO articulos (nombre_articulo, id_subrubro, id_rubro, marca, estado, fecha_reg, hora_reg, id_usuario) ";
$sql.="VALUES ('$nombre_articulo','$id_subrubro','$id_rubro','$marca','$estado','$fecha_act','$hora_actual','$id_usuario_cp')";

$query = $mysqli->query($sql);

$id_usuario_cp=$_SESSION["id_usuario"];

// Chequea si el usuario tiene movimientos
$sql8="SELECT movimiento ; 
$sql8.=FROM usuarios WHERE (id_usuario = $id_usuario_cp)";

$query8 = $mysqli->query($sql8);
$row8=$query8->fetch_assoc();
$movimiento8=$row8['movimiento'];

if($movimiento8=='no'){

    $sql9="UPDATE usuarios SET movimiento = 'si' ;
    $sql9.= WHERE (id_usuario = ".$id_usuario_cp.")"; 

    $query9 = $mysqli->query($sql9);

}

$_SESSION['producto_guardada']="si";
echo "<script>location.href = 'articulos.php'</script>";    

?>