<?php 
require("coneccion/connection.php");
session_start();

// Si se cerro la sesión por otro lado
$definido=isset($_SESSION['usuario']);
// No está definido la variable
if ($definido==false){

    header("Location:panel.php");
    exit();
         
}

if(isset($_GET['id_articulo'])) {

    $id_articulo=$_GET['id_articulo'];
    $nombre_articulo=$_GET['nombre_articulo'];
    $id_subrubro=$_GET['id_subrubro'];
    $id_rubro=$_GET['id_rubro'];
    $marca=$_GET['marca'];
    $modelo=$_GET['modelo'];
    $estado=$_GET['estado'];
    
    $_SESSION['id_articulo2']=$id_articulo;
    $_SESSION['nombre_articulo2']=$nombre_articulo;
    $_SESSION['id_subrubro2']=$id_subrubro;
    $_SESSION['id_rubro2']=$id_rubro;
    $_SESSION['marca2']=$marca;
    $_SESSION['modelo2']=$modelo;
    $_SESSION['estado2']=$estado;

}

?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title>Dir. de Arquitectura - articulo - Editar - Form</title>

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

<script>

  $(document).on('ready',function(){

    $('#btn-enviar').click(function(){

      // confirmation
      $.confirm({
      title: 'Mensaje',
      content: '¿Confirma en guardar?',
      animation: 'scale',
      closeAnimation: 'zoom',
        buttons: {
          confirm: {
          text: 'Si',
          btnClass: 'btn-orange',

            action: function(){

               var url = "articulos_editar_validar.php";     

               $.ajax({                        
               type: "POST",                 
               url: url,                    
               data: $("#formulario_nombre_articulo").serialize(),
               beforeSend: function () {
                $("#resp").html("<img src='imagen/loader-small.gif'/><font color='green'>&nbsp&nbspProcesando, por favor espere...</font>");
               },
               success: function(data)            
               {
                $('#resp').html(data);           
               }
               });          
             
            } // action: function(){

          }, // confirm: {

          cancelar: function(){
              
          } // cancelar: function()
    
        } // buttons
  
      }); // $.confirm

    });

  });

</script>

</head>
<body class="body1">

<nav class="navbar navbar-default">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      
      <p class="navbar-brand"><span class="menu2">Dir. de Arquitectura</span></p> 
      <p class="navbar-brand"><span class="menu2"><a href="panel.php">Menu</a></span></p> 
      <p class="navbar-brand"><span class="menu2"><a href="nombre_articulos.php">Volver</a></span></p> 

  </div>
    
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>

<div class="container">

  <p class="usuario3">

	 <span class="encab">
   <span class="text-danger">
    Fecha: <?php echo $_SESSION['fecha']; ?>
	  <br/>
	  Usuario: <?php echo $_SESSION['usuario']; ?>
   </span>  
	 </span>	

  </p>

  <h4>Editar nombre_articulo</h4>
  <span class="nombre_articulo">id_articulo: <?php echo $id_articulo; ?></span>
  <br/><br/>

    <form id="formulario_nombre_articulo" class="form-horizontal" method="post" action="return false" onsubmit="return false">

      <div class="form-group">
        <label for="nombre_articulo" class="control-label col-md-2">Nombre Artículo:</label>
        <div class="col-md-9">
          <input id="nombre_articulo" class="form-control" type="text" name="nombre_articulo" value="<?php echo $nombre_articulo ?>" size="100" maxlength="100" autofocus />
        </div>
      </div>

      <div class="form-group">
        <label for="id_subrubro" class="control-label col-md-2">Id Subrubro:</label>
        <div class="col-md-9">
          <input id="id_subrubro" class="form-control" type="text" name="id_subrubro" value="<?php echo $id_subrubro ?>" size="250" maxlength="250" />
        </div>
      </div>

      <div class="form-group">
        <label for="marca" class="control-label col-md-2">Marca:</label>
        <div class="col-md-7">
        <table>    
        <tr>    
          <td>  
          <input id="marca" class="form-control" type="text" name="marca" value="<?php echo($marca) ?>" size="20" maxlength="15" />
        </td> 
        </tr>    
        </table>          
        </div>
      </div>

      <div class="form-group">
        <label for="modelo" class="control-label col-md-2">Modelo:</label>
        <div class="col-md-7">
        <table>  
        <tr>  
          <td>
          <input id="modelo" class="form-control" type="text" name="modelo" value="<?php echo ($modelo) ?>" size="20" maxlength="15" />
          </td>          
        </tr>        
        </table>  
        </div>
      </div>

      <input id="id_articulo" class="form-control" type="hidden" name="id_articulo" value="<?php echo $id_articulo ?>"/>

      <div class="form-group">
        <div class="col-md-1 col-md-offset-2">
          <button id="btn-enviar" class="btn btn-success" ><b>Guardar</b></button>
        </div>
      </div>

      <div>&nbsp&nbsp</div>
      <div id="resp"></div>

    </form>

</div>

<div id="resultado"></div>
<br/>

<?php 

    if ( isset($_SESSION['nombre_articulo_mensaje']) && $_SESSION['nombre_articulo_mensaje'] == "si" ) {

      $_SESSION['nombre_articulo_mensaje']='no';
      $contenido_mensaje=$_SESSION['contenido_mensaje_prod'];
      echo "<script>
        
        $.alert({

              title: 'Mensaje',
              content: '<span style=color:red>$contenido_mensaje.</span>',
              animation: 'scale',
              closeAnimation: 'scale',
              buttons: {
                okay: {
                    text: 'Cerrar',
                    btnClass: 'btn-warning'
                }
              }
          }); 

      </script>";

    }

?>

<div class="panel-footer">
  <div class="container">
    
  </div>
</div>
</body>
</html>