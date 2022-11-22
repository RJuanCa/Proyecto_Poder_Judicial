<?php
 session_start();
define("NRO_REGISTROS",20);
require_once('coneccion/conexion.php');

// Si se cerro la sesión por otro lado
$definido=isset($_SESSION['usuario']);
// No está definido la variable
if ($definido==false){

    header("Location:index.php");

  exit();
         
}

$id_usuario=$_SESSION['id_usuario'];
$nro=0;

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Dir. de Arquitectura - Artículos - Lista</title>

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

  	background: blue;

  }
  .body1{

  	background:silver;

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
	Fecha: <?php  echo $_SESSION['fecha']; ?>
	<br/>
	Usuario: <?php  echo $_SESSION['usuario'];  ?>
	</span>
	</span>

  </p>		
  <div class="row">
    <div class="col-md-12">
      <h3>Artículos - Lista</h3>
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
	$sql = 'SELECT * FROM articulos  ORDER BY id_articulo ';
	
	/* Pagination Code starts */
	$per_page_html = '';
	$page = 1;
	$start=0;
	if(!empty($_POST["page"])) {
		$page = $_POST["page"];
		$start=($page-1) * NRO_REGISTROS ;
    $nro=$start;
	}
   
	$limit=" limit " . $start . "," . NRO_REGISTROS;
	$pagination_statement = $pdo_conn->prepare($sql);
	$pagination_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
	/*$pagination_statement->execute();*/

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
	/*$pdo_statement->execute(); */
	$resultados = $pdo_statement->fetchAll();
  
?>
<form name='frmSearch' action='' method='post'>
<div style='text-align:right;margin:20px 0px;'>



<div class="row">
  <div class="col-lg-6"></div>
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

<div class="table-responsive">

<p><span class="encab"><a href="reportes_inventario_vista.php">Actualizar Artículo</a></span></p>
<table class="table table-bordered table-hover">
  <thead>
	<tr class='th_color'>
  <th class='table-header' width='15%'>id Artículo</th>
	  <th class='table-header' width='25%'>Nom. Artículo</th>
	  <th class='table-header' width='15%'>Subrubro</th>
	  <th class='table-header' width='10%'>Rubro</th>
    <th class='table-header' width='20%'>Marca</th>
    <th class='table-header' width='20%'>Modelo</th>
    <th class='table-header' width='10%'>Estado</th>
    <th class='table-header' width='10%'>Existencia</th>
    <th class='table-header' width='20%'>Acción</th>
	</tr>
  </thead>
  <tbody id='table-body'>
	<?php
	if(!empty($resultados)) {
		foreach($resultados as $row) {
	?>
	  <tr class='table-row'>

		<td>
      <?php 
        $nro=$nro+1;
        echo $nro; 
      ?>
    </td>
    <td><?php echo $row['id_articulo']; ?></td>
		<td>
      <?php 
      $marca=$row['marca'];
      echo $marca; 
      ?>
    </td>
    <td>
      <div align="center">
      <?php echo number_format($row['cantidad_existencia'],0,',','.') ?>
      </div>
    </td>
    
		<td>
     <a href="articulos_reporte.php?id_articulo=<?php echo $row['id_articulo']?>">Ver |</a>
     <a href="#" onclick="Validar3(<?php echo $row['id_articulo']?>, '<?php echo $nro?>', '<?php echo $row['nombre_articulo']?>','<?php echo $row['id_subrubro']?>', '<?php echo $row['id_rubro']?>', '<?php echo $row['marca']?>', '<?php echo $row['modelo']?>', '<?php echo $row['estado']?>)">Editar</a>
     <a href="#" onclick="Validar4(<?php echo $row['id_articulo']?>, '<?php echo $nro?>')">Eliminar</a>
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
Página <?php echo $page; ?>

</div>
</div>
</div>
</div>
<script>

// Editar articulo
function Validar3(id_articulo, nombre_articulo, id_subrubro, id_rubro, marca, modelo, estado,existencia)
{

$.confirm({
title: 'Mensaje',
content: '¿Confirma en editar <br/> el articulo '+nombre_articulo+'?',
animation: 'scale',
closeAnimation: 'zoom',
buttons: {
    confirm: {
        text: 'Si',
        btnClass: 'btn-orange',

           action: function(){

           window.location.href="articulos_editar.php?id_articulo="+id_articulo+"&articulo="+articulo+"&descripcion="+descripcion+"&nombre_articulo="+nombre_articulo+"&precio_compra="+precio_compra+"&precio_final="+precio_final;           
             
           } // action: function(){

    }, // confirm: {

    cancelar: function(){
              
    } // cancelar: function()
    
  } // buttons
  
}); // $.confirm

}

// Eliminar articulo
function Validar4(id_articulo, nombre_articulo)
{

$.confirm({
title: 'Mensaje',
content: '¿Confirma en eliminar <br/> el articulo de reglon nro. '+nombre_articulo+'?',
animation: 'scale',
closeAnimation: 'zoom',
buttons: {
    confirm: {
        text: 'Si',
        btnClass: 'btn-orange',

           action: function(){

           window.location.href="articulos_eliminar_validar.php?nombre_articulo="+nombre_articulo;           
             
           } // action: function(){

    }, // confirm: {

    cancelar: function(){
              
    } // cancelar: function()
    
  } // buttons
  
}); // $.confirm

}

</script>

<?php 

if ( isset($_SESSION['articulo_guardada']) && $_SESSION['articulo_guardada'] == "si" ) {

    unset($_SESSION['articulo_guardada']);
    
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

if ( isset($_SESSION['articulo_eliminado']) && $_SESSION['articulo_eliminado'] == "si" ) {

    unset($_SESSION['articulo_eliminado']);
    
    echo "<script>

    $.confirm({
      title: 'Mensaje',
      content: '<span style=color:green>articulo eliminado con éxito.</span>',
      autoClose: 'Cerrar|3000',
      buttons: {
          Cerrar: function () {
            
          }
      }
    
    });</script>";

}

if ( isset($_SESSION['articulo_tiene_comprobante']) && $_SESSION['articulo_tiene_comprobante'] == "si" ) {

    unset($_SESSION['articulo_tiene_comprobante']);
    
    echo "<script>

    $.confirm({
      title: 'Mensaje',
      content: '<span style=color:red>No se puede eliminar el articulo <br/>porque tiene comprobantes.</span>',
      autoClose: 'Cerrar|3000',
      buttons: {
          Cerrar: function () {
            
          }
      }
    
    });</script>";

}

?>

<div class="panel-footer">
  <div class="container">
   	
  </div>
</div>
</body>
</html>