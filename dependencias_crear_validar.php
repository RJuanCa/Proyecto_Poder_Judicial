<?php  

sleep(1);

require("coneccion/connection.php");
session_start();

// Si se cerro la sesión por otro lado
$definido=isset($_SESSION['dependencias']);
// No está definido la variable
if ($definido==false){

	header("Location:index.php");
	exit();
         
}

//validación
$error_form = "";
if ($_POST["dependencia"] == "") {
    $nom_depen = ($_POST["dependencia"]);
    if ($nom_depen==false) {
        $_SESSION['contenido_mensaje_dependencia']='Debes escribir la dependencia';
        $_SESSION['dependencia_mensaje']='si';
        $_SESSION['responsable_dep']=$_POST["responsable_dep"];
         $_SESSION['nom_depen']=$_POST["nom_depen"];
        $_SESSION['cargo']=$_POST["cargo"];
        $_SESSION['direccion']=$_POST["direccion"];

        echo "<script>location.href = 'dependencias_crear.php?nom_depen=$nom_depen'</script>";
        exit();
    } else {
        $nom_depen=($_POST["dependencia"]);
    }
}
if ($_POST["responsable_dep"] == "") {
    $responsable_dep = ($_POST["responsable_dep"]);
    if ($responsable_dep==false) {
        $_SESSION['contenido_mensaje_dependencia']='Debes escribir el responsable de la Dependencia';
        $_SESSION['dependencia_mensaje']='si';
        $_SESSION['responsable_dep']=$_POST["responsable_dep"];
        $_SESSION['nom_depen']=$_POST["nom_depen"];
        $_SESSION['cargo']=$_POST["cargo"];
        $_SESSION['direccion']=$_POST["direccion"];

        echo "<script>location.href = 'dependencias_crear.php?nom_depen=$nom_depen'</script>";
        exit();
    } else {
        $responsable_dep=($_POST["responsable_dep"]);
    }
}

if ($_POST["cargo"] == "") {
    $cargo = ($_POST["cargo"]);
    if ($cargo==false) {
        $_SESSION['contenido_mensaje_dependencia']='Debes escribir la dependencia';
        $_SESSION['dependencia_mensaje']='si';
        $_SESSION['responsable_dep']=$_POST["responsable_dep"];
        $_SESSION['nom_depen']=$_POST["nom_depen"];
        $_SESSION['cargo']=$_POST["cargo"];
        $_SESSION['direccion']=$_POST["direccion"];

        echo "<script>location.href = 'dependencias_crear.php?nom_depen=$nom_depen'</script>";
        exit();
    } else {
        $cargo=($_POST["cargo"]);
    }
}

if ($_POST["direccion"] == "") {
    $direccion = ($_POST["direccion"]);
    if ($direccion==false) {
        $_SESSION['contenido_mensaje_dependencia']='Debes escribir la dependencia';
        $_SESSION['dependencia_mensaje']='si';
        $_SESSION['responsable_dep']=$_POST["responsable_dep"];
        $_SESSION['nom_depen']=$_POST["nom_depen"];
        $_SESSION['cargo']=$_POST["cargo"];
        $_SESSION['direccion']=$_POST["direccion"];

        echo "<script>location.href = 'dependencias_crear.php?nom_depen=$nom_depen'</script>";
        exit();
    } else {
        $direccion=($_POST["direccion"]);
    }
}

// Chequea que existe la dependencia
$sql20="SELECT nom_depen FROM dependencia WHERE (nom_depen = $nom_depen)";
$query20 = $mysqli->query($sql20);
//$row20=$query20->fetch_assoc();

if ($query20->num_rows!=0) {

    $_SESSION['contenido_mensaje_dependencia']='Dependencia ya existe';
    $_SESSION['dependencia_mensaje']='si';   
    $_SESSION['nom_depen']=$_POST["nom_depen"];
    $_SESSION['responsable_dep']=$_POST["responsable_dep"];
    $_SESSION['cargo']=$_POST["cargo"];
    $_SESSION['direccion']=$_POST["direccion"];
    

    echo "<script>location.href = 'dependencias_crear.php?nom_depen=$nom_depen'</script>";    
    exit();

}

$valores_fecha_act = explode('-', $_SESSION['fecha']);
$fecha_act=$valores_fecha_act[2]."-".$valores_fecha_act[1]."-".$valores_fecha_act[0];
$hora_actual=$_SESSION['hora_actual'];
$nom_depen=$_SESSION["nom_depen"];

// Guarda datos 
$sql21="INSERT INTO dependencia (nom_depen,responsable_dep, cargo, direccion, fecha_reg, hora_reg,);
$sql21.=VALUES ('$nom_depen','$responsable_dep','$cargo','$direccion','$fecha_act','$hora_actual')";

 echo $sql21;
 exit();

$query = $mysqli->query($sql);

// Chequea si la dependencia tiene movimientos
$sql8="SELECT movimiento; 
$sql8.=FROM dependencia WHERE (nom_depen = $nom_depen)";

$query8 = $mysqli->query($sql8);
$row8=$query8->fetch_assoc();
$movimiento8=$row8['movimiento'];

if($movimiento8=='no'){

    $sql9="UPDATE dependencia SET movimiento = 'si' ;
    $sql9.=WHERE (nom_depen = ".$nom_depen.")"; 
    $query9 = $mysqli->query($sql9);
}

$_SESSION['dependencia_guardado']="si";
echo "<script>location.href = 'buscar_dependencias.php'</script>";    

?>