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
    $_SESSION['cargo']=$_POST["cargo"];
    $_SESSION['direccion']=$_POST["direccion"];
    
   
    echo "<script>location.href = 'dependencias_crear.php?nac=$nac'</script>";    
    exit();

}else{

    $nac=$_POST["nac"];

}

if ($_POST["id_dep"] == "") {

    $_SESSION['contenido_mensaje_dependencia']='Debes escribir ';
    $_SESSION['dependencia_mensaje']='si';
   $_SESSION['responsable']=$_POST["responsable"];
    $_SESSION['nom_depen']=$_POST["nom_depen"];    
    $_SESSION['cargo']=$_POST["cargo"];
    $_SESSION['direccion']=$_POST["direccion"];
    

    echo "<script>location.href = 'dependencias_crear.php?nac=$nac'</script>";    
    exit();

}else{

    $id_dep=$_POST["id_dep"];

}

$id_dep_numero =  is_numeric($_POST["id_dep"]);
if ($id_dep_numero==false){

    $_SESSION['contenido_mensaje_dependencia']='';
    $_SESSION['dependencia_mensaje']='si';
    $_SESSION['responsable']=$_POST["responsable"];
    $_SESSION['nom_depen']=$_POST["nom_depen"];    
    $_SESSION['cargo']=$_POST["cargo"];
    $_SESSION['direccion']=$_POST["direccion"];
    

    echo "<script>location.href = 'dependencias_crear.php?nac=$nac'</script>";    
    exit();

}

$id_dep=($_POST["id_dep"]);
$id_dep = explode('.', $id_dep);

if ($id_dep){

    $_SESSION['contenido_mensaje_dependencia']='';
    $_SESSION['dependencia_mensaje']='si';
    $_SESSION['responsable']=$_POST["responsable"];
    $_SESSION['nom_depen']=$_POST["nom_depen"];    
    $_SESSION['cargo']=$_POST["cargo"];
    $_SESSION['direccion']=$_POST["direccion"];
    

    echo "<script>location.href = 'dependencias_crear.php?nac=$nac'</script>";    
    exit();

}


if ($_POST["responsable"] != "") {

    $responsable_numero =  is_numeric($_POST["responsable"]);
    if ($responsable_numero==false){
        
        $_SESSION['dependencia_mensaje']='si';
        $_SESSION['responsable']='si';       
        $_SESSION['nom_depen']=$_POST["nom_depen"];        
        $_SESSION['cargo']=$_POST["cargo"];
        $_SESSION['direccion']=$_POST["direccion"];
       

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
    $_SESSION['nom_depen']="";    
    $_SESSION['cargo']=$_POST["cargo"];
    $_SESSION['direccion']=$_POST["direccion"];
   

    echo "<script>location.href = 'dependencias_crear.php?nac=$nac'</script>";    
    exit();

}else{

    $dependencia=utf8_encode($_POST["dependencia"]);

}

if ($_POST["cargo"] == "") {

    $_SESSION['contenido_mensaje_dependencia']='Debes escribir el Teléfono';
    $_SESSION['dependencia_mensaje']='si';
    $_SESSION['responsable']=$_POST["responsable"];
    $_SESSION['nom_depen']=$_POST["nom_depen"];    
    $_SESSION['cargo']="";
    $_SESSION['direccion']=$_POST["direccion"];
    

    echo "<script>location.href = 'dependencias_crear.php?nac=$nac'</script>";    
    exit();

}else{

    $cargo=$_POST["cargo"];

}

if ($_POST["direccion"] == "") {

    $_SESSION['contenido_mensaje_dependencia']='Debes escribir la Dirección';
    $_SESSION['dependencia_mensaje']='si';
   $_SESSION['responsable']=$_POST["responsable"];
    $_SESSION['nom_depen']=$_POST["nom_depen"];    
    $_SESSION['cargo']=$_POST["cargo"];
    $_SESSION['direccion']="";
   

    echo "<script>location.href = 'dependencias_crear.php?nac=$nac'</script>";    
    exit();

}else{

    $direccion=utf8_encode($_POST["direccion"]);

}
if($responsable!=""){

    $id_dep=$id_dep."-".$responsable;

}

// Chequea que existe la dependencia
$sql20="SELECT nom_depen FROM dependencia WHERE (nom_depen = '$nom_depen')";
$query20 = $mysqli->query($sql20);
// $row20=$query20->fetch_assoc();

if ($query20->num_rows!=0) {

    $_SESSION['contenido_mensaje_dependencia']='Dependencia ya existe';
    $_SESSION['dependencia_mensaje']='si';
   $_SESSION['responsable']=$_POST["responsable"];
    $_SESSION['nom_depen']=$_POST["nom_depen"];
    $_SESSION['oficina']=$_POST["oficina"];
    $_SESSION['cargo']=$_POST["cargo"];
    $_SESSION['direccion']=$_POST["direccion"];
    

    echo "<script>location.href = 'dependencias_crear.php?nac=$nac'</script>";    
    exit();

}

$valores_fecha_act = explode('-', $_SESSION['fecha']);
$fecha_act=$valores_fecha_act[2]."-".$valores_fecha_act[1]."-".$valores_fecha_act[0];
$hora_actual=$_SESSION['hora_actual'];

$id_dep_cp=$_SESSION["id_dep"];

// Guarda datos 
$sql="INSERT INTO dependencia (id_dep, nom_depen, cargo, direccion, fecha_reg, hora_reg, id_dep) ";
$sql.="VALUES ('$id_dep','$nom_depen','$cargo','$direccion','$fecha_act','$hora_actual','$id_dep_cp')";

// echo $sql;
// exit();

$query = $mysqli->query($sql);

// Chequea si la dependencia tiene movimientos
$sql8="SELECT movimiento "; 
$sql8.="FROM dependencia WHERE (id_dep = $id_dep)";

$query8 = $mysqli->query($sql8);
$row8=$query8->fetch_assoc();
$movimiento8=$row8['movimiento'];

if($movimiento8=='no'){

    $sql9="UPDATE dependencia SET movimiento = 'si' ";
    $sql9.="WHERE (id_dep = ".$id_dep.")"; 

    $query9 = $mysqli->query($sql9);

}

$_SESSION['dependencia_guardado']="si";
echo "<script>location.href = 'buscar_dependencias.php'</script>";    

?>