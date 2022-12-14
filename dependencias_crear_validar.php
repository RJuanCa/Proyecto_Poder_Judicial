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

//validación
$error_form = "";

if ($_POST["nom_depen"] == "") {
    
    $_SESSION['contenido_mensaje_dependencia']='Debes escribir la Dependencia';
    $_SESSION['dependencia_mensaje']='si';    
    $nom_depen=$_POST['nom_depen'];
    $_SESSION['responsable_dep']=$_POST['responsable_dep'];
    $_SESSION['cargo']=$_POST["cargo"];
    $_SESSION['direccion']=$_POST["direccion"];

        echo "<script>location.href = 'dependencias_crear.php?nom_depen=$rnom_depen'</script>";
        exit();
    } else {
        $nom_depen=utf8_encode($_POST["nom_depen"]);
    }

    if ($_POST["responsable_dep"] == "") {
    
    $_SESSION['contenido_mensaje_dependencia']='Debes escribir el responsable de la Dependencia';
    $_SESSION['dependencia_mensaje']='si';    
    $nom_depen=$_POST['nom_depen'];
    $_SESSION['nom_depen']=$_POST["nom_depen"];
    $_SESSION['responsable_dep']="";
    $_SESSION['cargo']=$_POST["cargo"];
    $_SESSION['direccion']=$_POST["direccion"];

        echo "<script>location.href = 'dependencias_crear.php?responsable_dep=$responsable_dep'</script>";
        exit();
    } else {
        $responsable_dep=utf8_encode($_POST["responsable_dep"]);
    }

    if ($_POST["cargo"] == "") {
    
        $_SESSION['contenido_mensaje_dependencia']='Debes escribir qué cargo tiene el responsable de la Dependencia';
        $_SESSION['dependencia_mensaje']='si';
        $nom_depen=$_POST['nom_depen'];
        $_SESSION['nom_depen']=$_POST["nom_depen"];        
        $_SESSION['responsable_dep']=$_POST['responsable_dep'];         
        $_SESSION['cargo']="";
        $_SESSION['direccion']=$_POST["direccion"];

        echo "<script>location.href = 'dependencias_crear.php?cargo=$cargo'</script>";
        exit();
} else {
        $cargo=utf8_encode($_POST["cargo"]);
    }

    if ($_POST["direccion"] == "") {
    
        $_SESSION['contenido_mensaje_dependencia']='Debes escribir la dirección de la Dependencia';
        $_SESSION['dependencia_mensaje']='si';        
        $nom_depen=$_POST['nom_depen'];
        $_SESSION['nom_depen']=$_POST["nom_depen"];
        $_SESSION['responsable_dep']=$_POST['responsable_dep'];         
        $_SESSION['cargo']=$_POST['cargo'];
        $_SESSION['direccion']="";

        echo "<script>location.href = 'dependencias_crear.php ? direccion=$direccion'</script>";
        exit();
} else {
        $direccion=utf8_encode($_POST["direccion"]);
    }

// Chequea que existe la dependencia
$sql20="SELECT nom_depen FROM dependencia WHERE (nom_depen = $nom_depen)";
//$query20 = $mysqli->query($sql20);
//$row20=$query20->fetch_assoc();

if ($query20->num_rows!=0) {

    $_SESSION['contenido_mensaje_dependencia']='Dependencia ya existe';
    $_SESSION['dependencia_mensaje']='si';    
    $nom_depen=$_POST["nom_depen"];
    $_SESSION['responsable_dep']=$_POST["responsable_dep"];
    $_SESSION['cargo']=$_POST["cargo"];
    $_SESSION['direccion']=$_POST["direccion"];
    
    echo "<script>location.href = 'dependencias_crear.php?nom_depen=$nom_depen'</script>";    
    exit();

}

$valores_fecha_act = explode('-', $_SESSION['fecha']);
$fecha_act=$valores_fecha_act[2]."-".$valores_fecha_act[1]."-".$valores_fecha_act[0];
$hora_actual=$_SESSION['hora_actual'];
$id_usuario_cp=$_SESSION["id_usuario"];

// Guarda datos 
$sql21="INSERT INTO dependencia (nom_depen,direccion,responsable_dep, cargo,fecha_reg, hora_reg, id_usuario)VALUES ('$nom_depen','$direccion','$responsable_dep','$cargo','$fecha_act','$hora_actual','$id_usuario_cp')";

//echo $sql21;
 //exit();

$query = $mysqli->query($sql21);

// Chequea si el usuario tiene movimientos
$sql8="SELECT movimiento FROM usuarios WHERE (id_usuario = $id_usuario_cp)";

$query8 = $mysqli->query($sql8);
$row8=$query8->fetch_assoc();
$movimiento8=$row8['movimiento'];

if($movimiento8=='no'){

    $sql9="UPDATE usuarios SET movimiento = 'si';
    $sql9.=WHERE (id_usuario = $id_usuario_cp)"; 
    $query9 = $mysqli->query($sql9);
}

$_SESSION['dependencia_guardado']="si";
echo "<script>location.href = 'buscar_dependencias.php'</script>";    

?>