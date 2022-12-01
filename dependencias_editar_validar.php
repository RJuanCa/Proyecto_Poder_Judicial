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



$nom_depen = $_POST['nom_depen'];
echo $nom_depen;
exit();

$nom_depen;
$responsable_dep;
$cargo;
$direccion;


//validación
$error_form = "";


if ($_POST["nom_depen"] == "") {

    $_SESSION['contenido_mensaje_cliente']='Debes escribir la nombre de la Dependencia';
    $_SESSION['cliente_mensaje']='si';

    $nom_depen=$_SESSION['nom_depen2'];    
    $responsable_dep=$_SESSION['responsable_dep2'];
    $cargo=$_SESSION['cargo2'];
    $direccion=$_SESSION['direccion2'];    

    echo "<script>location.href = 'dependencias_editar.php?nom_depen=$nom_depen'</script>";    
    exit();

}

if ($_POST["responsable_dep"] == "") {

    $_SESSION['contenido_mensaje_cliente']='Debes escribir el responsable';
    $_SESSION['cliente_mensaje']='si';

    $nom_depen=$_SESSION['nom_depen2'];    
    $responsable_dep=$_SESSION['responsable_dep2'];
    $cargo=$_SESSION['cargo2'];
    $direccion=$_SESSION['direccion2'];   

    echo "<script>location.href = 'dependencias_editar.php?nom_depen=$nom_depen'</script>";    
    exit();

}

if ($_POST["cargo"] == "") {

    $_SESSION['contenido_mensaje_cliente']='Debes escribir el Cargo';
    $_SESSION['cliente_mensaje']='si';

    $nom_depen=$_SESSION['nom_depen2'];    
    $responsable_dep=$_SESSION['responsable_dep2'];
    $cargo=$_SESSION['cargo2'];
    $direccion=$_SESSION["direccion2"];

    echo "<script>location.href = 'dependencias_editar.php?nom_depen=$nom_depen'</script>";    
    exit();

}

if ($_POST["direccion"] == "") {

    $_SESSION['contenido_mensaje_cliente']='Debes escribir la Dirección';
    $_SESSION['cliente_mensaje']='si';
    
    $nom_depen=$_SESSION['nom_depen2'];    
    $responsable_dep=$_SESSION['responsable_dep2'];
    $cargo=$_SESSION['cargo2'];
    $direccion=$_SESSION['direccion2'];
    
    echo "<script>location.href = 'dependencias_editar.php?nom_depen=$nom_depen'</script>";    
    exit();

}

$nom_depen=$_POST['nom_depen'];
$responsable_dep=$_POST['responsable_dep'];
$cargo=$_POST['cargo'];
$direccion=$_POST['direccion'];


if($nom_depen!=$_SESSION['nom_depen_actual2']){
    
    //Chequea que existe la Dependencia
    $sql20="SELECT nom_depen FROM dependencia WHERE (nom_depen = '$nom_depen')";
    $query20 = $mysqli->query($sql20);
    // $row20=$query20->fetch_assoc();

    if ($query20->num_rows!=0) {

        $_SESSION['contenido_mensaje_cliente']='Dependencia ya existe';
        $_SESSION['cliente_mensaje']='si';

        $nom_depen=$_SESSION['nom_depen2'];        
        $responsable_dep=$_SESSION['responsable_dep2'];
        $cargo=$_SESSION['cargo2'];
        $direccion=$_SESSION["direccion2"];

        echo "<script>location.href = 'dependencias_editar.php?nom_depen=$nom_depen'</script>";    
        exit();

    }

}

$nom_depen=utf8_encode( $_POST['nom_depen']);
$responsable_dep=utf8_encode($_POST['responsable_dep']);
$cargo=utf8_encode( $_POST['cargo']);
$direccion=utf8_encode($_POST['direccion']);


// Guarda datos 
$sql="UPDATE dependencia SET nom_depen = '".$nom_depen."'," ;
$sql.= "responsable_dep = '".$responsable_dep."'," ;
$sql.= "cargo = '".$cargo."', direccion = '".$direccion."'," ;
$sql.= "WHERE (dependencia.nom_depen = '".$nom_depen."')";

$query = $mysqli->query($sql);
$id_usuario=$_SESSION["id_usuario"];

// Chequea si el usuario tiene movimientos
$sql8="SELECT movimiento" ; 
$sql8.= "FROM usuarios WHERE (id_usuario = $id_usuario)";
$query8 = $mysqli->query($sql8);
$row8=$query8->fetch_assoc();
$movimiento8=$row8['movimiento'];

if($movimiento8=='no'){

    $sql9="UPDATE usuarios SET movimiento = 'si' ";
    $sql9.="WHERE (id_usuario = ".$id_usuario.")"; 
    $query9 = $mysqli->query($sql9);

}

$_SESSION['dependencia_guardado']="si";
echo "<script>location.href = 'buscar_dependencias.php'</script>";    

?>