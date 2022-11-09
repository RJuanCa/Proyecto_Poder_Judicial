<?php 
require("coneccion/connection.php");
session_start();

// Si se cerro la sesión por otro lado
$definido=isset($_SESSION['usuario']);
// No está definido la variable
if ($definido==false){

    header("Location:error1.php");
    exit();
         
}

if(isset($_GET['id_nombre_articulo'])) {

    $id_nombre_articulo=$_GET['id_articulo'];
    $nombre_articulo=$_GET['nombre_articulo'];
    $id_subrubro=$_GET['id_subrubro'];
    $id_rubro=$_GET['id_rubro'];
    $precio_compra=$_GET['precio_compra'];
    $precio_final=$_GET['precio_final'];
    
    $_SESSION['id_nombre_articulo2']=$id_nombre_articulo;
    $_SESSION['nombre_articulo2']=$nombre_articulo;
    $_SESSION['id_subrubro2']=$id_subrubro;
    $_SESSION['id_rubro2']=$id_rubro;
    $_SESSION['precio_compra2']=$precio_compra;
    $_SESSION['precio_final2']=$precio_final;

}

?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title>Venezon - nombre_articulo - Editar - Form</title>

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

  .usuario3 {

    color:black;
    font-size:16px;
  
  }

  .th_color{

    background: green;

  }
  .navbar{

    background: yellow;

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
  .nombre_articulo
  {

    font-size:17px;
    color:blue;

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

               var url = "nombre_articulos_editar_validar.php";     

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
      
      <p class="navbar-brand"><span class="menu2">Venezon</span></p> 
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
  <span class="nombre_articulo">Código: <?php echo $id_rubro; ?></span>
  <br/><br/>

    <form id="formulario_nombre_articulo" class="form-horizontal" method="post" action="return false" onsubmit="return false">

      <div class="form-group">
        <label for="nombre_articulo" class="control-label col-md-2">nombre_articulo:</label>
        <div class="col-md-9">
          <input id="nombre_articulo" class="form-control" type="text" name="nombre_articulo" value="<?php echo $nombre_articulo ?>" size="100" maxlength="100" autofocus />
        </div>
      </div>

      <div class="form-group">
        <label for="id_subrubro" class="control-label col-md-2">Descripción:</label>
        <div class="col-md-9">
          <input id="id_subrubro" class="form-control" type="text" name="id_subrubro" value="<?php echo $id_subrubro ?>" size="250" maxlength="250" />
        </div>
      </div>

      <div class="form-group">
        <label for="precio_compra" class="control-label col-md-2">Precio Compra:</label>
        <div class="col-md-7">
        <table>    
        <tr>    
          <td>  
          <input id="precio_compra" class="form-control" type="text" name="precio_compra" value="<?php echo number_format($precio_compra,2,'.','') ?>" size="20" maxlength="15" />
        </td>
          <td>
            &nbsp&nbsppor ejemplo: 1200.71
          </td> 
        </tr>    
        </table>          
        </div>
      </div>

      <div class="form-group">
        <label for="precio_final" class="control-label col-md-2">Precio Final:</label>
        <div class="col-md-7">
        <table>  
        <tr>  
          <td>
          <input id="precio_final" class="form-control" type="text" name="precio_final" value="<?php echo number_format($precio_final,2,'.','') ?>" size="20" maxlength="15" />
          </td>
          <td>
            &nbsp&nbsppor ejemplo: 12528400.25
          </td>  
        </tr>        
        </table>  
        </div>
      </div>

      <input id="id_nombre_articulo" class="form-control" type="hidden" name="id_nombre_articulo" value="<?php echo $id_nombre_articulo ?>"/>

      <div class="form-group">
        <div class="col-md-1 col-md-offset-2">
          <button id="btn-enviar" class="btn btn-success" /><b>Guardar</b></button>
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
    <?php 
  	// mini Sistemas cjcv
  	require("mini.php"); 
	?>
  </div>
</div>
</body>
</html>