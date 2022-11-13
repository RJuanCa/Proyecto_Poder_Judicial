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

$id_usuario = $_POST['id_usuario'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];
$nombre = $_POST['nombre_apellido'];
$cargo = $_POST['cargo'];

//validación
$error_form = "";

if ($_POST["usuario"] == "") {

	$_SESSION['contenido_usuario_mensaje']='Debes escribir el Usuario';
    $_SESSION['usuario_mensaje']='si';

    $id_usuario=$_SESSION['id_usuario2'];
    $usuario = $_SESSION['usuario2'];
    $contrasena = $_POST['contrasena'];
    $nombre = $_POST['nombre_apellido'];
    $cargo = $_POST['cargo'];

    echo "<script>location.href = 'usuario_menu_form_editar.php?id_usuario=$id_usuario&usuario=$usuario&contrasena=$contrasena&nombre_apellido=$nombre&cargo=$cargo'</script>";    
	exit();

}

if ($_POST["contrasena"] == "") {

    $_SESSION['contenido_usuario_mensaje']='Debes escribir la Contraseña';
    $_SESSION['usuario_mensaje']='si';

    $id_usuario=$_SESSION['id_usuario2'];
    $usuario = $_POST['usuario2'];
    $contrasena =  $_SESSION['contrasena2'];
    $nombre = $_POST['nombre_apellido2'];
    $cargo = $_POST['cargo2'];

    echo "<script>location.href = 'usuario_menu_form_editar.php?id_usuario=$id_usuario&usuario=$usuario&contrasena=$contrasena&nombre_apellido=$nombre&cargo=$cargo'</script>";    
    exit();

}

if ($_POST["nombre_apellido"] == "") {

    $_SESSION['contenido_usuario_mensaje']='Debes escribir el nombre_apellido';
    $_SESSION['usuario_mensaje']='si';

    $id_usuario=$_SESSION['id_usuario2'];
    $usuario = $_POST['usuario2'];
    $contrasena = $_POST['contrasena2'];
    $nombre = $_SESSION['nombre_apellido2'];
    $cargo = $_POST['cargo2'];

    echo "<script>location.href = 'usuario_menu_form_editar.php?id_usuario=$id_usuario&usuario=$usuario&contrasena=$contrasena&nombre_apellido=$nombre&cargo=$cargo'</script>";    
    exit();

}

if ($_POST["cargo"] == "") {

    $_SESSION['contenido_usuario_mensaje']='Debes escribir el cargo';
    $_SESSION['usuario_mensaje']='si';

    $id_usuario=$_SESSION['id_usuario2'];
    $usuario = $_POST['usuario2'];
    $contrasena = $_POST['contrasena2'];
    $nombre = $_POST['nombre_apellido2'];
    $cargo = $_SESSION['cargo2'];

    echo "<script>location.href = 'usuario_menu_form_editar.php?id_usuario=$id_usuario&usuario=$usuario&contrasena=$contrasena&nombre_apellido=$nombre&cargo=$cargo'</script>";    
    exit();

}

// Guarda datos 
$sql="UPDATE usuarios SET usuario = '".utf8_encode($usuario)."', contrasena = '".$contrasena."', nombre_apellido = '".utf8_encode($nombre)."', cargo = '".$cargo."' ";
$sql.="WHERE (usuarios.id_usuario = ".$id_usuario.")"; 

$query = $mysqli->query($sql);

$_SESSION['usuario_guardado']="si";
echo "<script>location.href = 'usuario_menu.php'</script>";	

?>