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

// Viene de valida dependencias crear
if(isset($_GET["id_dep"])) {
  $id_dep=$_GET["id_dep"];
  $nom_depen=$_GET["nom_depen"];    
  $responsable_dep=$_SESSION["responsable_dep"];
  $cargo=$_SESSION["cargo"];
  $direccion=$_SESSION["direccion"];
    
   
}else{

  $id_dep="";    
  $nom_depen="";  
  $responsable_dep="";
  $cargo="";
  $direccion="";
} 

?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title>Dir. de Arquitectura - Dependencias - Crear - Form</title>

<link rel="stylesheet" href="demo/libs/bundled.css">
<script src="demo/libs/bundled.js"></script>
<script src="js/jquery-latest.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery-confirm.css"/>
<script type="text/javascript" src="js/jquery-confirm.js"></script>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script src="bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="fonts/style.css"/>
<link rel="shortcut icon" href="imagen/avatar.png" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>

<style type="text/css">

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

               var url = "dependencias_crear_validar.php";     

               $.ajax({                        
               type: "POST",                 
               url: url,                    
               data: $("#formulario_dependencia").serialize(),
               beforeSend: function () {
                $("#resp").html("<img src='imagen/loader-small.gif'/><font color='green'>&nbsp&nbspProcesando, por favor espere...</font>");
               },
               success: function(data)            
               {
                $("#resp").html(data);           
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
   
    <div class="navbar-header">
      
      <p class="navbar-brand"><span class="menu2">Dir. de Arquitectura</span></p> 
      <p class="navbar-brand"><span class="menu2"><a href="panel.php">Menú</a></span></p> 
      <p class="navbar-brand"><span class="menu2"><a href="buscar_dependencias.php">Volver</a></span></p> 

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
	  Usuario: <?php echo $_SESSION['usuario'];  ?>
   </span>  
	 </span>	

  </p>

  <h4><b>Agregar Dependencia</b></h4>

    <form id="formulario_dependencia" class="form-horizontal" method="POST" action="return false" onsubmit="return false">

      <div class="form-group">
        <label for="nom_depen" class="control-label col-md-2"><b><i>Dependencia:</i></b></label>
        <div class="col-md-1">
          
            <div class="input-group">
            <input id="nom_depen" style="width:420px" class="form-control" type="text" name="nom_depen" size="200" maxlength="200" autofocus value="<?php echo $nom_depen ?>"/>
            </div>
            <span class="input-group-addon">por ejemplo: JUZGADO DE FALTAS</span>

        </div>

      </div>      

      <div class="form-group">
        <label for="responsable_dep" class="control-label col-md-2"><b><i>Responsable:</i></b></label>
        <div class="col-md-9">
          <input id="responsable_dep" style="width:420px" class="form-control" type="text" name="responsable_dep" value="<?php echo  $responsable_dep ?>" size="20" maxlength="20" />
        </div>
      </div>

      <div class="form-group">
        <label for="cargo" class="control-label col-md-2"><b><i>Cargo:</i></b></label>
        <div class="col-md-9">
          <input id="cargo" style="width:420px" class="form-control" type="text" name="cargo" value="<?php echo $cargo ?>" size="50" maxlength="50" />
        </div>
      </div>

      <div class="form-group">
        <label for="direccion" class="control-label col-md-2"><b><i>Dirección:</i></b></label>
        <div class="col-md-9">
          <input id="direccion" style="width:420px" class="form-control" type="text" name="direccion" value="<?php echo $direccion ?>" size="100" maxlength="100" />
        </div>
      </div>      

      <div class="form-group">
        <div class="col-md-1 col-md-offset-2">
          <button id="btn-enviar" class="btn btn-success"><b>Guardar</b></button>
        </div>
      </div>

      <div>&nbsp&nbsp</div>
      <!--<div id="resp"></div>-->
      
    </form>

</div>

<div id="resultado"></div>
<br/>

<?php 

    if ( isset($_SESSION['dependencias_mensaje']) && $_SESSION['dependencias_mensaje'] == "si" ) {

      $_SESSION['dependencias_mensaje']='no';
      $contenido_mensaje=$_SESSION['contenido_mensaje_dependencias'];
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