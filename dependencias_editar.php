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

if(isset($_GET['id_dependencia'])) {

    $id_dependencia=$_GET['id_dependencia'];

    $sql="SELECT * FROM dependencias WHERE (id_dep = ".$id_dep.")";

    $query = $mysqli->query($sql);
    $row = $query->fetch_assoc(); 

    if ($query->num_rows!=0) {

      $_SESSION['dependencia_actual2']=$row['dependencia'];

      $valores_dependencia = explode('-', $row['dependencia']);

      $nac=$valores_dependencia[0];
      $dependencia=$valores_dependencia[1];

      if(isset($valores_dependencia[2])){

        $rif_inicial=$valores_dependencia[2];

      }else{

        $rif_inicial="";                

      }
      if(isset($valores_dependencia[2])){

        $rif_final=$valores_dependencia[2];

      }else{

        $rif_final="";                

      }

      
      $responsable=utf8_decode($row['responsable']);
      $cargo=$row['cargo'];
      $direccion=utf8_decode($row['direccion']);
      $_SESSION['id_dependencia2']=$id_dependencia;
     $_SESSION['dependencia2']=$dependencia;     
      $_SESSION['responsable2']=$responsable;
      $_SESSION['cargo2']=$cargo;
      $_SESSION['direccion2']=$direccion;
      

    } else { // $row = $query->fetch_assoc()

      echo "dependencia no existe.";
      exit();

    } // $row = $query->fetch_assoc()

} 

?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title>Dir. de Arquitectura - Dependencias - Editar - Form</title>

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
  .dependencia
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

               var url = "dependencias_editar_validar.php";     

               $.ajax({                        
               type: "POST",                 
               url: url,                    
               data: $("#formulario_dependencia").serialize(),
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
    Fecha: <?php  echo $_SESSION['fecha']; ?>
	  <br/>
	  Usuario: <?php  echo $_SESSION['usuario']; ?>
   </span>  
	 </span>	

  </p>

  <h4>Editar Dependencia</h4>
 
    <form id="formulario_dependencia" class="form-horizontal" method="post" action="return false" onsubmit="return false">

      <div class="form-group">
        <label for="dependencia" class="control-label col-md-2">Dependencia:</label>
        <div class="col-md-1">
          
            <div class="input-group">
            <input id="dependencia" style="width:200px" class="form-control" type="text" name="dependencia" size="20" maxlength="20" value="<?php echo $dependencia ?>"/>
            </div>
            <span class="input-group-addon">por ejemplo: JUZGADO DE FALTAS</span>
         
        </div>
      </div>
      
      <div class="form-group">
        <label for="responsable" class="control-label col-md-2">Responsable:</label>
        <div class="col-md-9">
          <input id="responsable" class="form-control" type="text" name="responsable" size="20" maxlength="20" value="<?php echo $responsable ?>"/>
        </div>
      </div>

      <div class="form-group">
        <label for="cargo" class="control-label col-md-2">Cargo:</label>
        <div class="col-md-9">
          <input id="cargo" class="form-control" type="text" name="cargo" size="50" maxlength="50" value="<?php echo $cargo ?>"/>
        </div>
      </div>

      <div class="form-group">
        <label for="direccion" class="control-label col-md-2">Dirección:</label>
        <div class="col-md-9">
          <input id="direccion" class="form-control" type="text" name="direccion" size="100" maxlength="100" value="<?php echo $direccion ?>"/>
        </div>
      </div>      

      <input id="id_dependencia" class="form-control" type="hidden" name="id_dependencia" value="<?php echo $id_dependencia ?>"/>

      <div class="form-group">
        <div class="col-md-1 col-md-offset-2">
          <button id="btn-enviar" class="btn btn-success"><b>Guardar</b></button>
        </div>
      </div>

      <div>&nbsp&nbsp</div>
      <div id="resp"></div>

    </form>

</div>

<div id="resultado"></div>
<br/>

<?php 

    if ( isset($_SESSION['dependencia_mensaje']) && $_SESSION['dependencia_mensaje'] == "si" ) {

      $_SESSION['dependencia_mensaje']='no';
      $contenido_mensaje=$_SESSION['contenido_mensaje_dependencia'];
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
  	// mini Sistemas RJC
  	require("mini.php"); 
	?>
  </div>
</div>
</body>
</html>