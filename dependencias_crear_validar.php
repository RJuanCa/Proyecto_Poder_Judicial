<?php  

sleep(1);

require("coneccion/connection.php");
session_start();

// Si se cerro la sesión por otro lado
$definido=isset($_SESSION['dependencias']);
// No está definido la variable
if ($definido==false){

	header("Location:error1.php");
	exit();
         
}

//validación
$error_form = "";

if ($_POST["nac"] == "") {

	$_SESSION['contenido_mensaje_dependencia']='Debes escribir el campo antes ';
    $_SESSION['dependencia_mensaje']='si';
    $_SESSION['responsable']='si';
   $_SESSION['dependencia']=$_POST["dependencia"];
    $_SESSION['oficina']=$_POST["oficina"];
    $_SESSION['telefono']=$_POST["telefono"];
    $_SESSION['direccion']=$_POST["direccion"];
    $_SESSION['correo']=$_POST["correo"];
   
    echo "<script>location.href = 'dependencias_crear.php?nac=$nac'</script>";    
    exit();

}else{

    $nac=$_POST["nac"];

}

if ($_POST["cedula"] == "") {

    $_SESSION['contenido_mensaje_dependencia']='Debes escribir ';
    $_SESSION['dependencia_mensaje']='si';

   $_SESSION['responsable']=$_POST["responsable"];
    $_SESSION['dependencia']=$_POST["dependencia"];
    $_SESSION['oficina']=$_POST["oficina"];
    $_SESSION['telefono']=$_POST["telefono"];
    $_SESSION['direccion']=$_POST["direccion"];
    $_SESSION['correo']=$_POST["correo"];

    echo "<script>location.href = 'dependencias_crear.php?nac=$nac'</script>";    
    exit();

}else{

    $cedula=$_POST["cedula"];

}

$cedula_numero =  is_numeric($_POST["cedula"]);
if ($cedula_numero==false){

    $_SESSION['contenido_mensaje_dependencia']='La Cédula o Rif debe ser un número';
    $_SESSION['dependencia_mensaje']='si';

    $_SESSION['responsable']=$_POST["responsable"];
    $_SESSION['dependencia']=$_POST["dependencia"];
    $_SESSION['oficina']=$_POST["oficina"];
    $_SESSION['telefono']=$_POST["telefono"];
    $_SESSION['direccion']=$_POST["direccion"];
    $_SESSION['correo']=$_POST["correo"];

    echo "<script>location.href = 'dependencias_crear.php?nac=$nac'</script>";    
    exit();

}

$cedula_decimal=number_format($_POST["cedula"],1);
$cedula_decimal = explode('.', $cedula_decimal);

if ($cedula_decimal[1]!=0){

    $_SESSION['contenido_mensaje_dependencia']='La Cédula debe ser un número entero';
    $_SESSION['dependencia_mensaje']='si';

    $_SESSION['responsable']=$_POST["responsable"];
    $_SESSION['dependencia']=$_POST["dependencia"];
    $_SESSION['oficina']=$_POST["oficina"];
    $_SESSION['telefono']=$_POST["telefono"];
    $_SESSION['direccion']=$_POST["direccion"];
    $_SESSION['correo']=$_POST["correo"];

    echo "<script>location.href = 'dependencias_crear.php?nac=$nac'</script>";    
    exit();

}


if ($_POST["responsable"] != "") {

    $responsable_numero =  is_numeric($_POST["responsable"]);
    if ($responsable_numero==false){

        
        $_SESSION['dependencia_mensaje']='si';
        $_SESSION['responsable']='si';       
        $_SESSION['dependencia']=$_POST["dependencia"];
        $_SESSION['oficina']=$_POST["oficina"];
        $_SESSION['telefono']=$_POST["telefono"];
        $_SESSION['direccion']=$_POST["direccion"];
        $_SESSION['correo']=$_POST["correo"];

        echo "<script>location.href = 'dependencias_crear.php?nac=$nac'</script>";    
        exit();

    }

}

if ($_POST["responsable"] == "") {

    $responsable="";

}else{

    $responsable=$_POST["responsable"];

}

if ($_POST["dependencia"] == "") {

    $_SESSION['contenido_mensaje_dependencia']='Debes escribir la dependencia';
    $_SESSION['dependencia_mensaje']='si';

   $_SESSION['responsable']=$_POST["responsable"];
    $_SESSION['dependencia']="";
    $_SESSION['oficina']=$_POST["oficina"];
    $_SESSION['telefono']=$_POST["telefono"];
    $_SESSION['direccion']=$_POST["direccion"];
    $_SESSION['correo']=$_POST["correo"];

    echo "<script>location.href = 'dependencias_crear.php?nac=$nac'</script>";    
    exit();

}else{

    $dependencia=utf8_encode($_POST["dependencia"]);

}

if ($_POST["oficina"] == "") {

    $_SESSION['contenido_mensaje_dependencia']='Debes escribir la oficina';
    $_SESSION['dependencia_mensaje']='si';

    $_SESSION['responsable']=$_POST["responsable"];
    $_SESSION['dependencia']=$_POST["dependencia"];
    $_SESSION['oficina']="";
    $_SESSION['telefono']=$_POST["telefono"];
    $_SESSION['direccion']=$_POST["direccion"];
    $_SESSION['correo']=$_POST["correo"];

    echo "<script>location.href = 'dependencias_crear.php?nac=$nac'</script>";    
    exit();

}else{

    $oficina=utf8_encode($_POST["oficina"]);

}

if ($_POST["telefono"] == "") {

    $_SESSION['contenido_mensaje_dependencia']='Debes escribir el Teléfono';
    $_SESSION['dependencia_mensaje']='si';

    $_SESSION['responsable']=$_POST["responsable"];
    $_SESSION['dependencia']=$_POST["dependencia"];
    $_SESSION['oficina']=$_POST["oficina"];
    $_SESSION['telefono']="";
    $_SESSION['direccion']=$_POST["direccion"];
    $_SESSION['correo']=$_POST["correo"];

    echo "<script>location.href = 'dependencias_crear.php?nac=$nac'</script>";    
    exit();

}else{

    $cargo=$_POST["telefono"];

}

if ($_POST["direccion"] == "") {

    $_SESSION['contenido_mensaje_dependencia']='Debes escribir la Dirección';
    $_SESSION['dependencia_mensaje']='si';

   $_SESSION['responsable']=$_POST["responsable"];
    $_SESSION['dependencia']=$_POST["dependencia"];
    $_SESSION['oficina']=$_POST["oficina"];
    $_SESSION['telefono']=$_POST["telefono"];
    $_SESSION['direccion']="";
    $_SESSION['correo']=$_POST["correo"];

    echo "<script>location.href = 'dependencias_crear.php?nac=$nac'</script>";    
    exit();

}else{

    $direccion=utf8_encode($_POST["direccion"]);

}

if ($_POST["correo"] == "") {

    $_SESSION['contenido_mensaje_dependencia']='Debes escribir el Correo';
    $_SESSION['dependencia_mensaje']='si';

    $_SESSION['responsable']=$_POST["responsable"];
    $_SESSION['dependencia']=$_POST["dependencia"];
    $_SESSION['oficina']=$_POST["oficina"];
    $_SESSION['telefono']=$_POST["telefono"];
    $_SESSION['direccion']=$_POST["direccion"];
    $_SESSION['correo']="";

    echo "<script>location.href = 'dependencias_crear.php?nac=$nac'</script>";    
    exit();

}else{

    $correo=$_POST["correo"];

}

$cedula=$nac."-".$cedula;

if($responsable!=""){

    $cedula=$cedula."-".$responsable;

}

// Chequea que existe la dependencia
$sql20="SELECT dependencia FROM tab_dependencias WHERE (dependencia = '$dependencia')";
$query20 = $mysqli->query($sql20);
// $row20=$query20->fetch_assoc();

if ($query20->num_rows!=0) {

    $_SESSION['contenido_mensaje_dependencia']='Dependencia ya existe';
    $_SESSION['dependencia_mensaje']='si';

   $_SESSION['responsable']=$_POST["responsable"];
    $_SESSION['dependencia']=$_POST["dependencia"];
    $_SESSION['oficina']=$_POST["oficina"];
    $_SESSION['telefono']=$_POST["telefono"];
    $_SESSION['direccion']=$_POST["direccion"];
    $_SESSION['correo']=$_POST["correo"];

    echo "<script>location.href = 'dependencias_crear.php?nac=$nac'</script>";    
    exit();

}

$valores_fecha_act = explode('-', $_SESSION['fecha']);
$fecha_act=$valores_fecha_act[2]."-".$valores_fecha_act[1]."-".$valores_fecha_act[0];
$hora_actual=$_SESSION['hora_actual'];

$id_dependencias_cp=$_SESSION["id_dependencias"];

// Guarda datos 
$sql="INSERT INTO tab_dependencias (cedula, dependencia, oficina, telefono, direccion, correo, fecha_reg, hora_reg, id_dependencias) ";
$sql.="VALUES ('$cedula','$dependencia','$oficina','$cargo','$direccion','$correo','$fecha_act','$hora_actual','$id_dependencias_cp')";

// echo $sql;
// exit();

$query = $mysqli->query($sql);

// Chequea si la dependencia tiene movimientos
$sql8="SELECT movimiento "; 
$sql8.="FROM tab_dependencias WHERE (id_dependencia = $id_dependencia_cp)";

$query8 = $mysqli->query($sql8);
$row8=$query8->fetch_assoc();
$movimiento8=$row8['movimiento'];

if($movimiento8=='no'){

    $sql9="UPDATE tab_dependenciass SET movimiento = 'si' ";
    $sql9.="WHERE (id_dependencias = ".$id_dependencias_cp.")"; 

    $query9 = $mysqli->query($sql9);

}

$_SESSION['dependencia_guardado']="si";
echo "<script>location.href = 'buscar_dependencias.php'</script>";    

?>