
<?php

include("../conexion.php");

$bd = conectar();
$sql = "SELECT Perfil FROM contadorImagenes";
$result= mysqli_query($bd,$sql);

while($mostrar=mysqli_fetch_array($result)){
    $valor = $mostrar['Perfil'];
}
$numeroValor = (int) $valor;

$sql = "UPDATE contadorImagenes SET Perfil= $numeroValor+1 WHERE Id=1";
$result= mysqli_query($bd,$sql);



// File name
$filename = $_FILES['file']['name'];

// Valid file extensions
$valid_extensions = array("jpg","jpeg","png","pdf");

// File extension
$extension = pathinfo($filename, PATHINFO_EXTENSION);

$usuario = $_POST['usuario'];

// Check extension
if(in_array(strtolower($extension),$valid_extensions) ) {

   // Upload file
   $pathImagen = "../images/perfiles/".$usuario.'G'.$numeroValor.'G'.$filename;


   if(move_uploaded_file($_FILES['file']['tmp_name'], $pathImagen)){
     $sql = "UPDATE usuario SET ImagenPerfil= '$pathImagen' WHERE Usuario='$usuario'";
     $result= mysqli_query($bd,$sql);
     $mandar['path'] = $pathImagen;
     $mandar['result'] = true;
      echo json_encode($mandar);
   }else{
     $mandar['path'] = 'doc';
     $mandar['result'] = false;

      echo json_encode($mandar);
   }
}else{
  $mandar['path'] = 'doc';
  $mandar['result'] = false;

   echo json_encode($mandar);
}

exit;

?>
