<?php 

include 'auth.php';

if (isset($_REQUEST['id'])){
	$id = $_REQUEST['id'];
    $query = "SELECT ID_CRITICIDAD,
		             NOMBRE,
			         DESCRIPCION,
			         SIMBOLO
  		     	FROM CRITICIDAD
		       WHERE ID_CRITICIDAD='".$id."'";
	
	$stid = oci_parse($conn, $query);
	oci_execute($stid, OCI_DEFAULT);
	$rowe = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
} else {
	$rowe="";
}

?>

<!DOCTYPE html>
<html>
<link rel="shortcut icon" href="img/docs.png">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Criticidad</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="lib/font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="lib/ionicons-2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="css/skins/_all-skins.min.css">
  
<!-- Parsley Style -->
  <style type="text/css">
  .parsley-required{
  color: red;
  }
  </style>
<!-- End Parsley Style -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php
	include 'menu.php';
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Criticidad
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-10">
        
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              <div style ="float: right">
               <div class="box-footer">
                <a class="btn btn-danger" href="criticidad.php">Regresar</a>
               </div>
             </div>
             <div style="clear: both"></div>
              
              <form role="form" method="post" action="criticidad_grabar.php" enctype="multipart/form-data" id="form" autocomplete="off">
                
                <!-- text input -->
                <div class="form-group">
                  <label>Nombre: </label>
                  <input type="text" class="form-control" placeholder="Nombre de la criticidad..." name="nombre" value="<?php  if(empty($rowe['NOMBRE'])){echo"";}else{echo $rowe['NOMBRE'];}?>" required>
                </div>
                
                <div class="form-group">
                  <label>ID: </label>
                  <input type="text" class="form-control" placeholder="ID" name="id_criticidad" value="<?php  if(empty($rowe['ID_CRITICIDAD'])){echo"";}else{echo $rowe['ID_CRITICIDAD'];}?>" maxlength="1" style="text-transform:uppercase" required>
                </div>
                
                <!-- textarea -->
                <div class="form-group">
                  <label>Descripci??n: </label>
                  <textarea class="form-control" rows="3" placeholder="Descripci??n..." name="descripcion" required><?php  if(empty($rowe['DESCRIPCION'])){echo"";}else{echo $rowe['DESCRIPCION'];}?></textarea>
                </div>
                <!-- file -->
                <div class="form-group">
                  <label for="exampleInputFile">Imagen: </label>
                  <input type="file" id="exampleInputFile" name="imagen" <?php  if(empty($rowe['SIMBOLO'])){echo"required";}?>>

                  <p class="help-block">IMPORTANTE: la imagen no debe contener caracteres especiales y/o espacios.</p>
                  <?php  if(empty($rowe['SIMBOLO'])){echo"";}else{echo "<img src=".$rowe['SIMBOLO']." style='width: 150px'>";}?>
                </div>
                
			   <div class="box-footer">
                <button type="submit" class="btn btn-primary">Grabar</button>
                <input type="hidden" value="<?php if(isset($id)){echo $id;}?>" name="id">
                <input type="hidden" value="<?php  if(empty($rowe['SIMBOLO'])){echo"";}else{echo $rowe['SIMBOLO'];}?>" name="img">
              </div>
              
              </form>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="lib/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="lib/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>

<!-- Script y plugins para validacion -->
<script src="lib/Parsley.js-2.6.2/dist/parsley.min.js"></script>
<script src="lib/Parsley.js-2.6.2/dist/i18n/es.js"></script>

<script type="text/javascript">
$(function () {
  $('#form').parsley().on('field:validated', function() {
    var ok = $('.parsley-error').length === 0;
    $('.bs-callout-info').toggleClass('hidden', !ok);
    $('.bs-callout-warning').toggleClass('hidden', ok);
  })
  .on('form:submit', function() {
   // return false; // Don't submit form for this demo
  });
});
</script>
<!-- Fin Script y plugins para validacion -->
	
<?php 

if(isset($_GET['grabar']))
{
if ($_GET['grabar'] == 1){
echo '<script>
	  alert("Datos grabados exitosamente!")	
	 </script>';
}
if ($_GET['grabar'] == 2){
	echo '<script>
	  alert("La imagen que esta intentando grabar ya existe")
	 </script>';
}
if ($_GET['grabar'] == 3){
	echo '<script>
	  alert("Ocurri??? un problema, intentelo de nuevo")
	 </script>';
}
if ($_GET['grabar'] == 4){
	echo '<script>
	  alert("No es un formato de imagen valido")
	 </script>';
}
}

?>
</body>
</html>
