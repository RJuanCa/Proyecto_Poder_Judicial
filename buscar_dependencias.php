<?php
session_start();
define("NRO_REGISTROS",10);
require_once('coneccion/conexion.php');

// Si se cerro la sesión por otro lado
$definido=isset($_SESSION['usuario']);
// No está definido la variable
if ($definido==false){

    header("Location:index.php");

  exit();
         
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">	
<title>Dir. de Arquitectura - Dependencias - Lista</title>

<link rel="stylesheet" href="demo/libs/bundled.css">
<script src="demo/libs/bundled.js"></script>
<script src="js/jquery-latest.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery-confirm.css"/>
<script type="text/javascript" src="js/jquery-confirm.js"></script>

<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script src="bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="fonts/style.css">

<link rel="shortcut icon" href="imagen/avatar.png" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

<style type="text/css">
  .pagina {
   padding:8px 16px;
   border:1px solid #ccc;
   color:#000;
   font-weight:bold;
  }
  .usuario3 {

	color:black;
	font-size:16px;
	
  }
  .th_color{

  	background: #0a3172;

  }
  .navbar{

  	background: #0a3172;

  }
  .body1{

  	background:grey;

  }
  .menu2{

  	font-size:24px;
  	color:black;

  }
  .encab{

  	font-size:18px;

  }

  @media screen and (max-width:400px ) {

  .menu2{

  	font-size:19px;
  	color:black;

   }
   
  }	  
  
</style>
</head>
<body class="body1">

<nav class="navbar navbar-default">
  <div class="container"> 
    <!-- Marca y alternar se agrupan para una mejor visualización móvil -->
    <div class="navbar-header">
      
      <p class="navbar-brand"><span class="menu2">Dir. de Arquitectura</span></p> 
      <p class="navbar-brand"><span class="menu2"><a href="panel.php">Menú</a></span></p> 

    </div>
    
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>

<div class="container">
  <p class="usuario3">

  	<span class="encab">
  	<span class="text-danger">
		Fecha:  <?php  echo $_SESSION['fecha'];  ?>
		<br/>
		Usuario:  <?php echo $_SESSION['usuario']; ?>
	</span>
	</span>

  </p>	
  <div class="row">
    <div class="col-md-12">
      <h2>Dependencias - Lista</h2>
    </div>
  </div>
  <div class="row">
  	<div class="col-md-12">
<div class="panel-body">
<?php
function verfecha($vfecha)
{
$fch=explode("-",$vfecha);
$tfecha=$fch[2]."-".$fch[1]."-".$fch[0];
return $tfecha;
}
  
	$search_keyword = '';
	if(!empty($_POST['search']['keyword'])) {
		$search_keyword = $_POST['search']['keyword'];
	}
	$sql = 'SELECT * FROM dependencia WHERE nom_depen LIKE :keyword OR direccion LIKE :keyword OR responsable_dep LIKE :keyword ORDER BY nom_depen, responsable_dep ';
	
	/* Pagination Code starts */
	$per_page_html = '';
	$page = 1;
	$start=0;
	if(!empty($_POST["page"])) {
		$page = $_POST["page"];
		$start=($page-1) * NRO_REGISTROS;
	}
	$limit=" limit " . $start . "," . NRO_REGISTROS;
	$pagination_statement = $pdo_conn->prepare($sql);
	$pagination_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
	$pagination_statement->execute();

	$row_count = $pagination_statement->rowCount();
	if(!empty($row_count)){
		$per_page_html .= "<div style='text-align:center;margin:20px 0px;'>";
		$page_count=ceil($row_count/NRO_REGISTROS);
		if($page_count>1) {
			for($i=1;$i<=$page_count;$i++){
				if($i==$page){
					$per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page current" />';
				} else {
					$per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page" />';
				}
			}
		}
		$per_page_html .= "</div>";
	}
	
	$query = $sql.$limit;
	$pdo_statement = $pdo_conn->prepare($query);
	$pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
	$pdo_statement->execute();
	$resultados = $pdo_statement->fetchAll();
?>
<form name='frmSearch' action='' method='post'>
<div style='text-align:right;margin:20px 0px;'>

<!--<input type='text' name='search[keyword]' value="<?php echo $search_keyword; ?>" id='keyword' maxlength='25'>-->

<div class="row"><div class="col-lg-6"></div>
  <div class="col-lg-6">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Buscar..."  name='search[keyword]' value="<?php echo $search_keyword; ?>" id='keyword' maxlength='50'>
      <span class="input-group-btn">
        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
</div>
<p><span class="encab"><a href="dependencias_crear.php">Agregar Dependencia</a></span></p>
<div class="table-responsive">
<table class="table table-bordered table-hover">
  <thead>
	<tr class='th_color'>
	  	  
	  <th class='table-header' width='20%'>Juzgado</th>
	  <th class='table-header' width='30%'>Responsable</th>
	  <th class='table-header' width='30%'>Direccion</th>
	  <th class='table-header' width='26%'>Acción</th>

	</tr>
  </thead>
  <tbody id='table-body'>
	<?php
	if(!empty($resultados)) {
		foreach($resultados as $row) {
	?>
	  <tr class='table-row'>
		
		<td><?php echo $row['nom_depen']; ?></td>
		<td><?php echo $row['responsable_dep']; ?></td>
		<td><?php echo $row['direccion']; ?></td>
		<td>
      
      <a href="dependencias_reporte.php?id_dep=<?php echo $row['id_dep']?>">Ver| </a>
      <a href="#" onclick="Validar3(<?php  echo $row['id_dep'] ?>, '<?php  echo $row['nom_depen']  ?>')">Editar| </a>
      <a href="#" onclick="Validar4(<?php  echo $row['id_dep'] ?>, '<?php  echo $row['nom_depen']  ?>')">Eliminar| </a>
      <a href="buscar_comprobante.php?id_dep=<?php  echo $row['id_dep']  ?>">Comprobantes|</a>

    </td>

	  </tr>
    <?php
		}
	}
	?>
  </tbody>

</table>
</div>
<?php echo $per_page_html; ?>
</form>

</div>
</div>
  </div>
</div>
<script>

// Editar dependencia
function Validar3(id_dep, nom_depen)
{

$.confirm({
title: 'Mensaje',
content: '¿Confirma en editar <br/> la dependencia '+nom_depen+'?',
animation: 'scale',
closeAnimation: 'zoom',
buttons: {
    confirm: {
        text: 'Si',
        btnClass: 'btn-orange',

           action: function(){

           window.location.href="dependencias_editar.php?id_dep="+id_dep;           
             
           } // action: function(){

    }, // confirm: {

    cancelar: function(){
              
    } // cancelar: function()
    
  } // buttons
  
}); // $.confirm

}

// Eliminar dependencia
function Validar4(id_dep, nom_depen)
{

$.confirm({
title: 'Mensaje',
content: '¿Confirma en eliminar <br/> la dependencia '+nom_depen+'?',
animation: 'scale',
closeAnimation: 'zoom',
buttons: {
    confirm: {
        text: 'Si',
        btnClass: 'btn-orange',

           action: function(){

           window.location.href="dependencia_eliminar_validar.php?id_dep="+id_dep;           
             
           } // action: function(){

    }, // confirm: {

    cancelar: function(){
              
    } // cancelar: function()
    
  } // buttons
  
}); // $.confirm

}

</script>

<?php 

// Dependencia guardada
if ( isset($_SESSION['dependencia_guardada']) && $_SESSION['dependencia_guardada'] == "si" ) {

    unset($_SESSION['dependencia_guardada']);
    
    echo "<script>

    $.confirm({
      title: 'Mensaje',
      content: '<span style=color:green>Datos guardado con éxito.</span>',
      autoClose: 'Cerrar|3000',
      buttons: {
          Cerrar: function () {
            
          }
      }
    
    });</script>";

}

if ( isset($_SESSION['dependencia_eliminado']) && $_SESSION['dependencia_eliminado'] == "si" ) {

    unset($_SESSION['dependencia_eliminado']);
    
    echo "<script>

    $.confirm({
      title: 'Mensaje',
      content: '<span style=color:green>Dependencia eliminada con éxito.</span>',
      autoClose: 'Cerrar|3000',
      buttons: {
          Cerrar: function () {
            
          }
      }
    
    });</script>";

}

if ( isset($_SESSION['dependencia_tiene_comprobante']) && $_SESSION['dependencia_tiene_comprobante'] == "si" ) {

    unset($_SESSION['dependencia_tiene_comprobante']);
    
    echo "<script>

    $.confirm({
      title: 'Mensaje',
      content: '<span style=color:red>No se puede eliminar la dependencia <br/>porque tiene comprobantes.</span>',
      autoClose: 'Cerrar|3000',
      buttons: {
          Cerrar: function () {
            
          }
      }
    
    });</script>";

}

?>

  </div>
</div>

</body>
</html>