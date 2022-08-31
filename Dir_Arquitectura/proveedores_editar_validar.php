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

/*

$producto = $_POST['nombre_comercio'];
echo $nombre_comercio;
exit();

$id_proveedor
$cuit
$nombre_comercio
$comercio
$telefono
$direccion
$correo

*/

//validación
$error_form = "";

if ($_POST["nac"] == "") {

    $_SESSION['contenido_mensaje_proveedor']='Debes escribir el campo antes de la CUIT';
    $_SESSION['proveedor_mensaje']='si';

    $id_proveedor=$_SESSION['id_proveedor2'];
    $cuit=$_SESSION['cuit2'];
    $nombre_comercio=$_SESSION["nombre_comercio2"];
    $comercio=$_SESSION['comercio2'];
    $telefono=$_SESSION['telefono2'];
    $direccion=$_SESSION['direccion2'];
    $correo=$_SESSION['correo2'];
   
    echo "<script>location.href = 'proveedores_editar.php?id_proveedor=$id_proveedor'</script>";    
    exit();

}

if ($_POST["cuit"] == "") {

    $_SESSION['contenido_mensaje_proveedor']='Debes escribir el CUIT';
    $_SESSION['proveedor_mensaje']='si';

    $id_proveedor=$_SESSION['id_proveedor2'];
    $cuit=$_SESSION['cuit'];
    $nombre_comercio=$_SESSION["nombre_comercio2"];
    $comercio=$_SESSION['comercio2'];
    $telefono=$_SESSION['telefono2'];
    $direccion=$_SESSION['direccion2'];
    $correo=$_SESSION['correo2'];
    

    echo "<script>location.href = 'proveedores_editar.php?id_proveedor=$id_proveedor'</script>";    
    exit();

}

$cuit_numero =  is_numeric($_POST["cuit"]);
if ($cuit_numero==false){

    $_SESSION['contenido_mensaje_proveedor']='La Cuit debe ser un número';
    $_SESSION['proveedor_mensaje']='si';

    $id_cliente=$_SESSION['id_cliente2'];
    $nac=$_SESSION['nac2'];
    $cuit=$_SESSION['cuit2'];
    $rif_final=$_SESSION['rif_final2'];
    $nombre_comercio=$_SESSION["nombre_comercio2"];
    $comercio=$_SESSION['comercio2'];
    $telefono=$_SESSION['telefono2'];
    $direccion=$_SESSION['direccion2'];
    $correo=$_SESSION['correo2'];

    echo "<script>location.href = 'clientes_editar.php?id_cliente=$id_cliente'</script>";    
    exit();

}

$cuit_decimal=number_format($_POST["cuit"],1);
$cuit_decimal = explode('.', $cuit_decimal);

if ($cuit_decimal[1]!=0){

    $_SESSION['contenido_mensaje_proveedor']='La Cédula o Rif debe ser un número entero';
    $_SESSION['proveedor_mensaje']='si';

    $id_cliente=$_SESSION['id_cliente2'];
    $nac=$_SESSION['nac2'];
    $cuit=$_SESSION['cuit2'];
    $rif_final=$_SESSION['rif_final2'];
    $nombre_comercio=$_SESSION["nombre_comercio2"];
    $comercio=$_SESSION['comercio2'];
    $telefono=$_SESSION['telefono2'];
    $direccion=$_SESSION['direccion2'];
    $correo=$_SESSION['correo2'];

    echo "<script>location.href = 'clientes_editar.php?id_cliente=$id_cliente'</script>";      
    exit();

}

if ($_POST["rif_final"] != "") {

    $rif_final_numero =  is_numeric($_POST["rif_final"]);
    if ($rif_final_numero==false){

        $_SESSION['contenido_mensaje_proveedor']='Numeral del Cuit debe ser un número';
        $_SESSION['proveedor_mensaje']='si';

        $id_cliente=$_SESSION['id_cliente2'];
        $nac=$_SESSION['nac2'];
        $cuit=$_SESSION['cuit2'];
        $rif_final=$_SESSION['rif_final2'];
        $nombre_comercio=$_SESSION["nombre_comercio2"];
        $comercio=$_SESSION['comercio2'];
        $telefono=$_SESSION['telefono2'];
        $direccion=$_SESSION['direccion2'];
        $correo=$_SESSION['correo2'];

        echo "<script>location.href = 'clientes_editar.php?id_cliente=$id_cliente'</script>";    
        exit();

    }

}

if ($_POST["rif_final"] == "") {

    $rif_final="";

}else{

    $rif_final=$_POST["rif_final"];

}

if ($_POST["nombre_comercio"] == "") {

	$_SESSION['contenido_mensaje_proveedor']='Debes escribir el nombre_comercio';
    $_SESSION['proveedor_mensaje']='si';

    $id_proveedor=$_SESSION['id_proveedor2'];
    $nac=$_SESSION['nac2'];
    $cuit=$_SESSION['cuit2'];
    $nombre_comercio=$_SESSION["nombre_comercio2"];
    $comercio=$_SESSION['comercio2'];
    $telefono=$_SESSION['telefono2'];
    $direccion=$_SESSION['direccion2'];
    $correo=$_SESSION['correo2'];
    

    echo "<script>location.href = 'proveedores_editar.php?id_proveedor=$id_proveedor'</script>";    
	exit();

}

if ($_POST["comercio"] == "") {

    $_SESSION['contenido_mensaje_proveedor']='Debes escribir el comercio';
    $_SESSION['proveedor_mensaje']='si';

    $id_proveedor=$_SESSION['id_proveedor2'];
    $nac=$_SESSION['nac2'];
    $cuit=$_SESSION['cuit2'];
    $nombre_comercio=$_SESSION["nombre_comercio2"];
    $comercio=$_SESSION['comercio2'];
    $telefono=$_SESSION['telefono2'];
    $direccion=$_SESSION['direccion2'];
    $correo=$_SESSION['correo2'];
    

    echo "<script>location.href = 'proveedores_editar.php?id_proveedor=$id_proveedor'</script>";    
    exit();

}

if ($_POST["telefono"] == "") {

    $_SESSION['contenido_mensaje_proveedor']='Debes escribir el Teléfono';
    $_SESSION['proveedor_mensaje']='si';

    $id_proveedor=$_SESSION['id_proveedor2'];
    $nac=$_SESSION['nac2'];
    $cuit=$_SESSION['cuit2'];
    $nombre_comercio=$_SESSION["nombre_comercio2"];
    $comercio=$_SESSION['comercio2'];
    $telefono=$_SESSION['telefono2'];
    $direccion=$_SESSION['direccion2'];
    $correo=$_SESSION['correo2'];
    

    echo "<script>location.href = 'proveedores_editar.php?id_proveedor=$id_proveedor'</script>";    
    exit();

}

if ($_POST["direccion"] == "") {

    $_SESSION['contenido_mensaje_proveedor']='Debes escribir la Dirección';
    $_SESSION['proveedor_mensaje']='si';

    $id_proveedor=$_SESSION['id_proveedor2'];
    $nac=$_SESSION['nac2'];
    $cuit=$_SESSION['cuit2'];
    $nombre_comercio=$_SESSION["nombre_comercio2"];
    $comercio=$_SESSION['comercio2'];
    $telefono=$_SESSION['telefono2'];
    $direccion=$_SESSION['direccion2'];
    $correo=$_SESSION['correo2'];
    

    echo "<script>location.href = 'proveedores_editar.php?id_proveedor=$id_proveedor'</script>";    
    exit();

}

if ($_POST["correo"] == "") {

    $_SESSION['contenido_mensaje_proveedor']='Debes escribir el Correo';
    $_SESSION['proveedor_mensaje']='si';

    $id_proveedor=$_SESSION['id_proveedor2'];
    $nac=$_SESSION['nac2'];
    $cuit=$_SESSION['cuit2'];
    $nombre_comercio=$_SESSION["nombre_comercio2"];
    $comercio=$_SESSION['comercio2'];
    $telefono=$_SESSION['telefono2'];
    $direccion=$_SESSION['direccion2'];
    $correo=$_SESSION['correo2'];
   

    echo "<script>location.href = 'proveedores_editar.php?id_proveedor=$id_proveedor'</script>";    
    exit();

}

if ($_POST["comercio"] == "") {

    $_SESSION['contenido_mensaje_proveedor']='Debes escribir el Comercio';
    $_SESSION['proveedor_mensaje']='si';

    $id_proveedor=$_SESSION['id_proveedor2'];
    $nac=$_SESSION['nac2'];
    $cuit=$_SESSION['cuit2'];
    $nombre_comercio=$_SESSION["nombre_comercio2"];
    $comercio=$_SESSION['comercio2'];
    $telefono=$_SESSION['telefono2'];
    $direccion=$_SESSION['direccion2'];
    $correo=$_SESSION['correo2'];
    

    echo "<script>location.href = 'proveedores_editar.php?id_proveedor=$id_proveedor'</script>";    
    exit();

}

$nac=$_POST['nac'];
$cuit=$_POST['cuit'];
$rif_final=$_POST['rif_final'];

$cuit=$nac."-".$cuit;

if($rif_final!=""){

    $cuit=$cuit."-".$rif_final;

}

if($cuit!=$_SESSION['cuit_actual2']){

    // Chequea que existe la cédula o rif del proveedor
    $sql20="SELECT cuit FROM tab_proveedores WHERE (cuit = '$cuit')";
    $query20 = $mysqli->query($sql20);
    // $row20=$query20->fetch_assoc();

    if ($query20->num_rows!=0) {

        $_SESSION['contenido_mensaje_proveedor']='Cuit ya existe';
        $_SESSION['proveedor_mensaje']='si';

        $id_cliente=$_SESSION['id_cliente2'];
        $nac=$_SESSION['nac2'];
        $cuit=$_SESSION['cuit2'];
        $nombre_comercio=$_SESSION["nombre_comercio2"];
        $comercio=$_SESSION['comercio2'];
        $telefono=$_SESSION['telefono2'];
        $direccion=$_SESSION['direccion2'];
        $correo=$_SESSION['correo2'];

        echo "<script>location.href = 'clientes_editar.php?id_cliente=$id_cliente'</script>";    
        exit();

    }

}

$id_proveedor=$_POST["id_proveedor"];
$nombre_comercio=utf8_encode($_POST["nombre_comercio"]);
$comercio=utf8_encode($_POST['comercio']);
$telefono=$_POST['telefono'];
$direccion=utf8_encode($_POST['direccion']);
$correo=$_POST['correo'];


// Guarda datos 
$sql="UPDATE tab_proveedores SET nac = '".$nac."', cuit = '".$cuit."', ";
$sql.="nombre_comercio = '".$nombre_comercio."', comercio = '".$comercio."', ";
$sql.="telefono = '".$telefono."', direccion = '".$direccion."', ";
$sql.="correo = '".$correo."', comercio = '".$comercio."' ";
$sql.="WHERE (tab_proveedores.id_proveedor = ".$id_proveedor.")";

$query = $mysqli->query($sql);

$id_usuario_cp=$_SESSION["id_usuario"];

// Chequea si el usuario tiene movimientos
$sql8="SELECT movimiento "; 
$sql8.="FROM tab_usuarios WHERE (id_usuario = $id_usuario_cp)";

$query8 = $mysqli->query($sql8);
$row8=$query8->fetch_assoc();
$movimiento8=$row8['movimiento'];

if($movimiento8=='no'){

    $sql9="UPDATE tab_usuarios SET movimiento = 'si' ";
    $sql9.="WHERE (id_usuario = ".$id_usuario_cp.")"; 

    $query9 = $mysqli->query($sql9);

}

$_SESSION['proveedor_guardado']="si";
echo "<script>location.href = 'buscar_proveedores.php'</script>";    

?>