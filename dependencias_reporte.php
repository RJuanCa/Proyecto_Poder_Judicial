<?php 
require("coneccion/connection.php");
   session_start();

// Si se cerro la sesión por otro lado
$definido=isset($_SESSION['usuario']);
// No está definido la variable
if ($definido==false){

    header("Location:index.php");
    exit();
         
}

if(isset($_GET['nom_depen'])) {

    $nom_depen=$_GET['nom_depen'];
   
}

// Tabla dependencia
$sql2="SELECT * FROM dependencia WHERE (nom_depen = $nom_depen)";
$query2 = $mysqli->query($sql2);

if($query2->num_rows==0){

    echo "No hay datos para mostrar";
    exit();

}

$row2=$query2->fetch_assoc();

$valores_fecha_act = explode('-', $row2['fecha_reg']);
$fecha_act=$valores_fecha_act[2]."-".$valores_fecha_act[1]."-".$valores_fecha_act[0];

 echo $nom_depen;
 exit();

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title>Dir. de Arquitectura - Dependencias - Vista</title>

<link rel="stylesheet" href="demo/libs/bundled.css">
<script src="demo/libs/bundled.js"></script>
<script src="js/jquery-latest.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery-confirm.css"/>
<script type="text/javascript" src="js/jquery-confirm.js"></script>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script src="bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="fonts/style.css">
<link rel="shortcut icon" href="imagen/logoPoderJud150x550.png" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

<style type="text/css">
  .usuario3 {

	  color:black;
	  font-size:16px;
	
  }
  .clientelabel{

    font-size:16px; 
    font-weight: bold;

  }
   .clientedato{

    font-size:16px; 
    
  }
  @media screen and (max-width:400px ) {

  .usuario3 {

    color:black;
    font-size:14px;
  
  }
  .clientelabel{

    font-size:14px; 
    font-weight: bold;

  }
   .clientedato{

    font-size:14px; 
    
  }
   
  }   
    
</style>

<script>
function printe(){
  //desaparece el boton
  document.getElementById("menu").style.display='none';
  document.getElementById("volver").style.display='none';
  document.getElementById("Imprimir").style.display='none';
  
  //se imprime la pagina
  window.print();
  //reaparece el boton
  document.getElementById("menu").style.display='inline';
  document.getElementById("volver").style.display='inline';
  document.getElementById("Imprimir").style.display='inline';
  
}
</script>

</head>

<body>

<div class="container">

<br/>

<div class="form-horizontal">

  <div class="form-group">

    <img src='imagen/logoPoderJud150x550.png' alt='logo venezon' width='50%' height='auto'>

  </div>

  <div class="form-group">
 
    <span class="clientelabel">Responsable:</span>
    <span class="clientedato"><?php echo $row2['responsable_dep'] ?></span>
    <br/>

    <span class="clientelabel">Juzgado:</span>
    <span class="clientedato"><?php echo utf8_decode($row2['nom_depen']) ?></span>
    <br/>        

    <span class="clientelabel">Dirección:</span>
    <span class="clientedato"><?php echo utf8_decode($row2['direccion']) ?></span>
    <br/>
    
    <span class="clientelabel">Fecha Registro:</span>
    <span class="clientedato"><?php echo $fecha_act ?></span>
    <br/>

    <span class="clientelabel">Hora Registro:</span>
    <span class="clientedato"><?php echo $row2['hora_reg'] ?></span>
    <br/>

  </div> <!-- class="form-group" -->

  <div class="form-group">

    <div class="usuario3">
    <a id="menu" href="panel.php">Menú | </a>
    <a id="volver" href="Buscar_dependencias.php">Volver | </a>
    <a href="#" id="Imprimir" onclick="printe()">Imprimir</a> 
    </div>

  </div> <!-- class="form-group" -->  

</div>

</div> <!-- class="container" -->		
</body>
</html>