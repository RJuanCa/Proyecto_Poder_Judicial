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



$direccion=$direccion = $_POST['direccion'];
echo $direccion;
exit();

$id_dep;
$nom_depen;
$direccion;
$responsable_dep;
$cargo;



//validación
$error_form = "";

if ($_POST["nac"] == "") {

    $_SESSION['contenido_mensaje_cliente']='Debes escribir el campo antes de la Cédula o Rif';
    $_SESSION['cliente_mensaje']='si';
    $id_dep=$_SESSION['id_dependecia2'];
    $nom_depen=$_SESSION['nom_depen2'];
    $direccion=$_SESSION["direccion2"];
    $responsable_dep=$_SESSION['responsable_dep2'];
    $cargo=$_SESSION['cargo2'];
    
    echo "<script>location.href = 'dependencia_editar.php?id_dep=$id_dep'</script>";    
    exit();

}

if ($_POST["nom_depen"] == "") {

    $_SESSION['contenido_mensaje_cliente']='Debes escribir la nom_depen';
    $_SESSION['cliente_mensaje']='si';

    $id_dep=$_SESSION['id_dep2'];
    $nom_depen=$_SESSION['nom_depen2'];
    $direccion=$_SESSION["direccion2"];
    $responsable_dep=$_SESSION['responsable_dep2'];
    $cargo=$_SESSION['cargo2'];
    $direccion=$_SESSION['direccion2'];
    $correo=$_SESSION['correo2'];

    echo "<script>location.href = 'nom_depen_editar.php?id_dep=$id_dep'</script>";    
    exit();

}

$nom_depen_numero =  is_numeric($_POST["nom_depen"]);
if ($nom_depen_numero==false){

    $_SESSION['contenido_mensaje_cliente']='La nom_depen debe ser un nonmbre';
    $_SESSION['cliente_mensaje']='si';

    $id_dep=$_SESSION['id_dep2'];
    $nom_depen=$_SESSION['nom_depen2'];
    $direccion=$_SESSION["direccion2"];
    $responsable_dep=$_SESSION['responsable_dep2'];
    $cargo=$_SESSION['cargo2'];
   

    echo "<script>location.href = 'nom_depen_editar.php?id_dep=$id_dep'</script>";    
    exit();

}

$nom_depen_decimal=number_format($_POST["nom_depen"],1);
$nom_depen_decimal = explode('.', $nom_depen_decimal);

if ($nom_depen_decimal[1]!=0){

    $_SESSION['contenido_mensaje_cliente']='';
    $_SESSION['cliente_mensaje']='si';

    $id_dep=$_SESSION['id_dep2'];
    $nom_depen=$_SESSION['nom_depen2'];
    $direccion=$_SESSION["direccion2"];
    $responsable_dep=$_SESSION['responsable_dep2'];
    $cargo=$_SESSION['cargo2'];
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
        $nom_depen=$_SESSION['nom_depen2'];
        $rif_final=$_SESSION['rif_final2'];
        $direccion=$_SESSION["direccion2"];
        $responsable_dep=$_SESSION['responsable_dep2'];
        $cargo=$_SESSION['cargo2'];
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

if ($_POST["direccion"] == "") {

	$_SESSION['contenido_mensaje_cliente']='Debes escribir los direccion';
    $_SESSION['cliente_mensaje']='si';

    $id_cliente=$_SESSION['id_cliente2'];
    $nac=$_SESSION['nac2'];
    $nom_depen=$_SESSION['nom_depen2'];
    $direccion=$_SESSION["direccion2"];
    $responsable_dep=$_SESSION['responsable_dep2'];
    $cargo=$_SESSION['cargo2'];
    $direccion=$_SESSION['direccion2'];
    $correo=$_SESSION['correo2'];

    echo "<script>location.href = 'clientes_editar.php?id_cliente=$id_cliente'</script>";    
	exit();

}

if ($_POST["responsable_dep"] == "") {

    $_SESSION['contenido_mensaje_cliente']='Debes escribir los responsable_dep';
    $_SESSION['cliente_mensaje']='si';

    $id_cliente=$_SESSION['id_cliente2'];
    $nac=$_SESSION['nac2'];
    $nom_depen=$_SESSION['nom_depen2'];
    $direccion=$_SESSION["direccion2"];
    $responsable_dep=$_SESSION['responsable_dep2'];
    $cargo=$_SESSION['cargo2'];
    $direccion=$_SESSION['direccion2'];
    $correo=$_SESSION['correo2'];

    echo "<script>location.href = 'clientes_editar.php?id_cliente=$id_cliente'</script>";    
    exit();

}

if ($_POST["cargo"] == "") {

    $_SESSION['contenido_mensaje_cliente']='Debes escribir el Teléfono';
    $_SESSION['cliente_mensaje']='si';

    $id_cliente=$_SESSION['id_cliente2'];
    $nac=$_SESSION['nac2'];
    $nom_depen=$_SESSION['nom_depen2'];
    $direccion=$_SESSION["direccion2"];
    $responsable_dep=$_SESSION['responsable_dep2'];
    $cargo=$_SESSION['cargo2'];
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
    $nom_depen=$_SESSION['nom_depen2'];
    $direccion=$_SESSION["direccion2"];
    $responsable_dep=$_SESSION['responsable_dep2'];
    $cargo=$_SESSION['cargo2'];
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
    $nom_depen=$_SESSION['nom_depen2'];
    $direccion=$_SESSION["direccion2"];
    $responsable_dep=$_SESSION['responsable_dep2'];
    $cargo=$_SESSION['cargo2'];
    $direccion=$_SESSION['direccion2'];
    $correo=$_SESSION['correo2'];

    echo "<script>location.href = 'clientes_editar.php?id_cliente=$id_cliente'</script>";    
    exit();

}

$nac=$_POST['nac'];
$nom_depen=$_POST['nom_depen'];
$rif_final=$_POST['rif_final'];

$nom_depen=$nac."-".$nom_depen;

if($rif_final!=""){

    $nom_depen=$nom_depen."-".$rif_final;

}

if($nom_depen!=$_SESSION['nom_depen_actual2']){

    // Chequea que existe la cédula o rif del cliente
    $sql20="SELECT nom_depen FROM tab_clientes WHERE (nom_depen = '$nom_depen')";
    $query20 = $mysqli->query($sql20);
    // $row20=$query20->fetch_assoc();

    if ($query20->num_rows!=0) {

        $_SESSION['contenido_mensaje_cliente']='Cédula o Rif ya existe';
        $_SESSION['cliente_mensaje']='si';

        $id_cliente=$_SESSION['id_cliente2'];
        $nac=$_SESSION['nac2'];
        $nom_depen=$_SESSION['nom_depen2'];
        $direccion=$_SESSION["direccion2"];
        $responsable_dep=$_SESSION['responsable_dep2'];
        $cargo=$_SESSION['cargo2'];
        $direccion=$_SESSION['direccion2'];
        $correo=$_SESSION['correo2'];

        echo "<script>location.href = 'clientes_editar.php?id_cliente=$id_cliente'</script>";    
        exit();

    }

}

$id_cliente=$_POST["id_cliente"];
$direccion=utf8_encode($_POST["direccion"]);
$responsable_dep=utf8_encode($_POST['responsable_dep']);
$cargo=$_POST['cargo'];
$direccion=utf8_encode($_POST['direccion']);
$correo=$_POST['correo'];

// Guarda datos 
$sql="UPDATE tab_clientes SET nom_depen = '".$nom_depen."', ";
$sql.="direccion = '".$direccion."', responsable_dep = '".$responsable_dep."', ";
$sql.="cargo = '".$cargo."', direccion = '".$direccion."', ";
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