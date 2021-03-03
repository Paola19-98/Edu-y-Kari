
<?php 
  include 'conexion1.php';
  function alert($text,$func){
    echo "<script type='text/javascript'>alert('$text'); $func();</script>";
  }
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <body background="assets/images/paola.jpg">
 <head >
   <meta charset="UTF-8">
   <link rel="stylesheet" href="assets/css/regi.css">
   <title>Web</title>

 </head>
 <body>
    <?php  
date_default_timezone_set('America/Mexico_City');
$fecha_actual=date ("Y-m-d H:i:s");
  ?>
  <section class="clean" id="Registro">
    <center>
   <h1 class="Frase">Registro de Usuarios</h1>
          <form method="post">
          <div class="row">
              <div class="input-field col s6">
                  <input id="first_name" name="nombre" type="text" class="validate">
                  <label for="first_name">Nombre</label>
                </div>
                <div class="input-field col s6">
                  <input id="last_name"  name="apellido" type="text" class="validate">
                  <label for="last_name">Apellido</label>
                </div>
            </div>
            <div class="row">
                  <div class="input-field col s12">
                    <input  name="fecha" type="datetime" value="<?= $fecha_actual?>">
                    <label >Fecha</label>
                  </div>
            </div>
            <div class="row">
                  <div class="input-field col s12">
                    <input id="password" name="nip" type="password" class="validate">
                    <label for="password">NIP</label>
                  </div>
            </div>
            <div class="row">
                  <div class="input-field col s12">
                    <input id="Confpassword" name="conf_nip" type="password" class="validate">
                    <label for="Confpassword">Confirmar NIP</label>
                  </div>
            </div>
               <button type="submit" name="registrar" class="btn cyan darken-3 right">Registrar</button>
            </form>
          </center>
</section>
<?php 

  if (isset($_POST['registrar'])) {
    $id = "";
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha = $_POST['fecha'];
    $nip = $_POST['nip'];
    $conf_nip = $_POST['conf_nip'];

    if ($nombre != '' && $apellido != '' && $fecha != '' && $nip != '') {
      if ($nip == $conf_nip) {
        $consulta = mysqli_query($conexion,"SELECT COUNT(id) FROM registros");
          if ($row = mysqli_fetch_array($consulta)) {
            $id = $row[0];
          }

      mysqli_free_result($consulta);

      $id = dechex($id);
      $nip = md5($nip);

      $registro = mysqli_query($conexion,"INSERT INTO registros (id, nombre, apellido, fecha, nip)
         VALUES ('$id', '$nombre', '$apellido', '$fecha', '$nip') ")or die(mysqli_error());
      alert("Registro Exitoso","nulll");

      }else{
        alert("Contraseñas no coinciden.","registro");
      }
    }else{
      alert("Hay algunos campos vacios.","registro");
    }
  }  
 ?>
 </body>
 </html>
