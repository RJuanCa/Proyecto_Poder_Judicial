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


$nombre_articulo = $_POST['nombre_articulo'];
$id_subrubro = $_POST['id_subrubro'];
$id_articulo = $_POST['id_articulo'];

echo $nombre_articulo;
echo "<br/>";
echo $id_subrubro;
echo "<br/>";
echo $id_articulo;

exit();


//validación
$error_form = "";

if ($_POST["nombre_articulo"] == "") {

	$_SESSION['contenido_mensaje_prod']='Debes escribir el artículo';
    $_SESSION['producto_mensaje']='si';

    $id_articulo=$_SESSION['id_articulo2'];
    $nombre_articulo=$_SESSION['nombre_articulo2'];
    $id_subrubro=$_SESSION['id_subrubro2'];
    $id_rubro=$_SESSION['id_rubro2'];
    $marca=$_SESSION['marca2'];
    $modelo=$_SESSION['precio_final2'];

    echo "<script>location.href = 'articulos_editar.php?id_articulo=$id_articulo&nombre_articulo=$nombre_articulo&id_subrubro=$id_subrubro&id_rubro=$id_rubro&marca=$marca&modelo=$modelo'</script>";    
	exit();

}

if ($_POST["id_subrubro"] == "") {

	$_SESSION['contenido_mensaje_prod']='Debes escribir la Descripcion';
    $_SESSION['producto_mensaje']='si';

    $id_articulo=$_SESSION['id_articulo2'];
    $nombre_articulo=$_SESSION['nombre_articulo2'];
    $id_subrubro=$_SESSION['id_subrubro2'];
    $id_rubro=$_SESSION['id_rubro2'];
    $marca=$_SESSION['marca2'];
    $modelo=$_SESSION['precio_final2'];

    echo "<script>location.href = 'articulos_editar.php?id_articulo=$id_articulo&nombre_articulo=$nombre_articulo&id_subrubro=$id_subrubro&id_rubro=$id_rubro&marca=$marca&modelo=$modelo'</script>";        
	exit();

}

if ($_POST["marca"] == "") {

    $_SESSION['contenido_mensaje_prod']='Debes escribir el Precio Compra';
    $_SESSION['producto_mensaje']='si';

    $id_articulo=$_SESSION['id_articulo2'];
    $nombre_articulo=$_SESSION['nombre_articulo2'];
    $id_subrubro=$_SESSION['id_subrubro2'];
    $id_rubro=$_SESSION['id_rubro2'];
    $marca=$_SESSION['marca2'];
    $modelo=$_SESSION['precio_final2'];

    echo "<script>location.href = 'articulos_editar.php?id_articulo=$id_articulo&nombre_articulo=$nombre_articulo&id_subrubro=$id_subrubro&id_rubro=$id_rubro&marca=$marca&modelo=$modelo'</script>";        
    exit();

}

if ($_POST["modelo"] == "") {

    $_SESSION['contenido_mensaje_prod']='Debes escribir el Precio Final';
    $_SESSION['producto_mensaje']='si';

    $id_articulo=$_SESSION['id_articulo2'];
    $nombre_articulo=$_SESSION['nombre_articulo2'];
    $id_subrubro=$_SESSION['id_subrubro2'];
    $id_rubro=$_SESSION['id_rubro2'];
    $marca=$_SESSION['marca2'];
    $modelo=$_SESSION['precio_final2'];

    echo "<script>location.href = 'articulos_editar.php?id_articulo=$id_articulo&nombre_articulo=$nombre_articulo&id_subrubro=$id_subrubro&id_rubro=$id_rubro&marca=$marca&modelo=$modelo'</script>";        
    exit();

}


$modelo=$_POST["modelo"] ;

$nombre_articulo=utf8_encode($_POST['nombre_articulo']);
$id_subrubro=utf8_encode($_POST['id_subrubro']);
$marca=$_POST['marca'];
$modelo=$_POST['modelo'];
$id_articulo = $_POST['id_articulo'];

// Guarda datos 
$sql="UPDATE articulos SET nombre_articulo = .$nombre_articulo., id_subrubro = .$id_subrubro., marca = .$marca., modelo = .$modelo., ganancia = .$ganancia;
$sql.= WHERE (articulos.id_articulo = .$id_articulo.)"; 

$query = $mysqli->query($sql);

$id_usuario_cp=$_SESSION["id_usuario"];

// Chequea si el usuario tiene movimientos
$sql8="SELECT movimiento "; 
$sql8.="FROM usuarios WHERE (id_usuario = $id_usuario_cp)";

$query8 = $mysqli->query($sql8);
$row8=$query8->fetch_assoc();
$movimiento8=$row8['movimiento'];

if($movimiento8=='no'){

    $sql9="UPDATE usuarios SET movimiento = 'si' ";
    $sql9.="WHERE (id_usuario = ".$id_usuario_cp.")"; 

    $query9 = $mysqli->query($sql9);

}

$_SESSION['articulo_guardado']="si";
echo "<script>location.href = 'articulos.php'</script>";    

?>