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

$oficina=$producto = $_POST['oficina'];
echo $oficina;
exit();

$id_cliente
$dependencia
$oficina
$responsable
$telefono
$direccion
$correo

*/

//validación
$error_form = "";
/*
if ($_POST["nac"] == "") {

    $_SESSION['contenido_mensaje_cliente']='Debes escribir el campo antes de la Cédula o Rif';
    $_SESSION['cliente_mensaje']='si';

    $id_cliente=$_SESSION['id_cliente2'];
    $nac=$_SESSION['nac2'];
    $dependencia=$_SESSION['dependencia2'];
    $rif_final=$_SESSION['rif_final2'];
    $oficina=$_SESSION["oficina2"];
    $responsable=$_SESSION['responsable2'];
    $telefono=$_SESSION['telefono2'];
    $direccion=$_SESSION['direccion2'];
    $correo=$_SESSION['correo2'];

    echo "<script>location.href = 'clientes_editar.php?id_cliente=$id_cliente'</script>";    
    exit();

}
*/
if ($_POST["dependencia"] == "") {

    $_SESSION['contenido_mensaje_cliente']='Debes escribir la Dependencia';
    $_SESSION['cliente_mensaje']='si';

    $id_cliente=$_SESSION['id_cliente2'];
    $nac=$_SESSION['nac2'];
    $dependencia=$_SESSION['dependencia2'];
    $rif_final=$_SESSION['rif_final2'];
    $oficina=$_SESSION["oficina2"];
    $responsable=$_SESSION['responsable2'];
    $telefono=$_SESSION['telefono2'];
    $direccion=$_SESSION['direccion2'];
    $correo=$_SESSION['correo2'];

    echo "<script>location.href = 'clientes_editar.php?id_cliente=$id_cliente'</script>";    
    exit();

}
/*
$dependencia_numero =  is_numeric($_POST["dependencia"]);
if ($dependencia_numero==false){

    $_SESSION['contenido_mensaje_cliente']='La Dependencia debe ser un nonmbre';
    $_SESSION['cliente_mensaje']='si';

    $id_cliente=$_SESSION['id_cliente2'];
    $nac=$_SESSION['nac2'];
    $dependencia=$_SESSION['dependencia2'];
    $rif_final=$_SESSION['rif_final2'];
    $oficina=$_SESSION["oficina2"];
    $responsable=$_SESSION['responsable2'];
    $telefono=$_SESSION['telefono2'];
    $direccion=$_SESSION['direccion2'];
    $correo=$_SESSION['correo2'];

    echo "<script>location.href = 'clientes_editar.php?id_cliente=$id_cliente'</script>";    
    exit();

}
*/
$dependencia_decimal=number_format($_POST["dependencia"],1);
$dependencia_decimal = explode('.', $dependencia_decimal);

if ($dependencia_decimal[1]!=0){

    $_SESSION['contenido_mensaje_cliente']='La Cédula o Rif debe ser un número entero';
    $_SESSION['cliente_mensaje']='si';

    $id_cliente=$_SESSION['id_cliente2'];
    $nac=$_SESSION['nac2'];
    $dependencia=$_SESSION['dependencia2'];
    $rif_final=$_SESSION['rif_final2'];
    $oficina=$_SESSION["oficina2"];
    $responsable=$_SESSION['responsable2'];
    $telefono=$_SESSION['telefono2'];
    $direccion=$_SESSION['direccion2'];
    $correo=$_SESSION['correo2'];

    echo "<script>location.href = 'clientes_editar.php?id_cliente=$id_cliente'</script>";      
    exit();

}

/*
if ($_POST["rif_final"] != "") {

    $rif_final_numero =  is_numeric($_POST["rif_final"]);
    if ($rif_final_numero==false){

        $_SESSION['contenido_mensaje_cliente']='Numeral del Rif debe ser un número';
        $_SESSION['cliente_mensaje']='si';

        $id_cliente=$_SESSION['id_cliente2'];
        $nac=$_SESSION['nac2'];
        $dependencia=$_SESSION['dependencia2'];
        $rif_final=$_SESSION['rif_final2'];
        $oficina=$_SESSION["oficina2"];
        $responsable=$_SESSION['responsable2'];
        $telefono=$_SESSION['telefono2'];
        $direccion=$_SESSION['direccion2'];
        $correo=$_SESSION['correo2'];

        echo "<script>location.href = 'clientes_editar.php?id_cliente=$id_cliente'</script>";    
        exit();

    }

}
*/
if ($_POST["rif_final"] == "") {

    $rif_final="";

}else{

    $rif_final=$_POST["rif_final"];

}

if ($_POST["oficina"] == "") {

	$_SESSION['contenido_mensaje_cliente']='Debes escribir los oficina';
    $_SESSION['cliente_mensaje']='si';

    $id_cliente=$_SESSION['id_cliente2'];
    $nac=$_SESSION['nac2'];
    $dependencia=$_SESSION['dependencia2'];
    $oficina=$_SESSION["oficina2"];
    $responsable=$_SESSION['responsable2'];
    $telefono=$_SESSION['telefono2'];
    $direccion=$_SESSION['direccion2'];
    $correo=$_SESSION['correo2'];

    echo "<script>location.href = 'clientes_editar.php?id_cliente=$id_cliente'</script>";    
	exit();

}

if ($_POST["responsable"] == "") {

    $_SESSION['contenido_mensaje_cliente']='Debes escribir los responsable';
    $_SESSION['cliente_mensaje']='si';

    $id_cliente=$_SESSION['id_cliente2'];
    $nac=$_SESSION['nac2'];
    $dependencia=$_SESSION['dependencia2'];
    $oficina=$_SESSION["oficina2"];
    $responsable=$_SESSION['responsable2'];
    $telefono=$_SESSION['telefono2'];
    $direccion=$_SESSION['direccion2'];
    $correo=$_SESSION['correo2'];

    echo "<script>location.href = 'clientes_editar.php?id_cliente=$id_cliente'</script>";    
    exit();

}

if ($_POST["telefono"] == "") {

    $_SESSION['contenido_mensaje_cliente']='Debes escribir el Teléfono';
    $_SESSION['cliente_mensaje']='si';

    $id_cliente=$_SESSION['id_cliente2'];
    $nac=$_SESSION['nac2'];
    $dependencia=$_SESSION['dependencia2'];
    $oficina=$_SESSION["oficina2"];
    $responsable=$_SESSION['responsable2'];
    $telefono=$_SESSION['telefono2'];
    $direccion=$_SESSION['direccion2'];
    $correo=$_SESSION['correo2'];

    echo "<script>location.href = 'clientes_editar.php?id_cliente=$id_cliente'</script>";    
    exit();

}

if ($_POST["direccion"] == "") {

    $_SESSION['contenido_mensaje_cliente']='Debes escribir la Dirección';
    $_SESSION['cliente_mensaje']='si';

    $id_cliente=$_SESSION['id_cliente2'];
    $nac=$_SESSION['nac2'];
    $dependencia=$_SESSION['dependencia2'];
    $oficina=$_SESSION["oficina2"];
    $responsable=$_SESSION['responsable2'];
    $telefono=$_SESSION['telefono2'];
    $direccion=$_SESSION['direccion2'];
    $correo=$_SESSION['correo2'];

    echo "<script>location.href = 'clientes_editar.php?id_cliente=$id_cliente'</script>";    
    exit();

}

if ($_POST["correo"] == "") {

    $_SESSION['contenido_mensaje_cliente']='Debes escribir el Correo';
    $_SESSION['cliente_mensaje']='si';

    $id_cliente=$_SESSION['id_cliente2'];
    $nac=$_SESSION['nac2'];
    $dependencia=$_SESSION['dependencia2'];
    $oficina=$_SESSION["oficina2"];
    $responsable=$_SESSION['responsable2'];
    $telefono=$_SESSION['telefono2'];
    $direccion=$_SESSION['direccion2'];
    $correo=$_SESSION['correo2'];

    echo "<script>location.href = 'clientes_editar.php?id_cliente=$id_cliente'</script>";    
    exit();

}

$nac=$_POST['nac'];
$dependencia=$_POST['dependencia'];
$rif_final=$_POST['rif_final'];

$dependencia=$nac."-".$dependencia;

if($rif_final!=""){

    $dependencia=$dependencia."-".$rif_final;

}

if($dependencia!=$_SESSION['dependencia_actual2']){

    // Chequea que existe la cédula o rif del cliente
    $sql20="SELECT dependencia FROM tab_clientes WHERE (dependencia = '$dependencia')";
    $query20 = $mysqli->query($sql20);
    // $row20=$query20->fetch_assoc();

    if ($query20->num_rows!=0) {

        $_SESSION['contenido_mensaje_cliente']='Cédula o Rif ya existe';
        $_SESSION['cliente_mensaje']='si';

        $id_cliente=$_SESSION['id_cliente2'];
        $nac=$_SESSION['nac2'];
        $dependencia=$_SESSION['dependencia2'];
        $oficina=$_SESSION["oficina2"];
        $responsable=$_SESSION['responsable2'];
        $telefono=$_SESSION['telefono2'];
        $direccion=$_SESSION['direccion2'];
        $correo=$_SESSION['correo2'];

        echo "<script>location.href = 'clientes_editar.php?id_cliente=$id_cliente'</script>";    
        exit();

    }

}

$id_cliente=$_POST["id_cliente"];
$oficina=utf8_encode($_POST["oficina"]);
$responsable=utf8_encode($_POST['responsable']);
$telefono=$_POST['telefono'];
$direccion=utf8_encode($_POST['direccion']);
$correo=$_POST['correo'];

// Guarda datos 
$sql="UPDATE tab_clientes SET dependencia = '".$dependencia."', ";
$sql.="oficina = '".$oficina."', responsable = '".$responsable."', ";
$sql.="telefono = '".$telefono."', direccion = '".$direccion."', ";
$sql.="correo = '".$correo."' ";
$sql.="WHERE (tab_clientes.id_cliente = ".$id_cliente.")";

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

$_SESSION['cliente_guardado']="si";
echo "<script>location.href = 'buscar_clientes.php'</script>";    

?>