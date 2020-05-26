


<?php

include("../conexion.php");

$bd = conectar();
$sql = "SELECT Hito FROM contadorImagenes";
$result= mysqli_query($bd,$sql);

while($mostrar=mysqli_fetch_array($result)){
    $valor = $mostrar['Hito'];
}
$numeroValor = (int) $valor;

$sql = "UPDATE contadorImagenes SET Hito= $numeroValor+1 WHERE Id=1";
$result= mysqli_query($bd,$sql);


// File name
$filename = $_FILES['file']['name'];

// Valid file extensions
$valid_extensions = array("jpg","jpeg","png","pdf");

// File extension
$extension = pathinfo($filename, PATHINFO_EXTENSION);

$titulo = $_POST['titulo'];
$categoria = $_POST['categoria'];
$usuario = $_POST['usuario'];
$detalle = $_POST['detalle'];
$fecha = $_POST['fecha'];
$fuente = $_POST['fuente'];
$comentario = $_POST['comentario'];

// Check extension
if(in_array(strtolower($extension),$valid_extensions) ) {

   // Upload file
   $pathImagen = "../images/hitos/".$usuario.'G'.$numeroValor.'G'.$filename;

   if(move_uploaded_file($_FILES['file']['tmp_name'], $pathImagen)){

     $sql = "INSERT INTO hito(Titulo,Categoria,Usuario,DetalleSuceso,Fecha,Fuente,Comentario,Imagen,Likes,Dislikes,Aprobado,Estado) VALUES(
        '$titulo','$categoria','$usuario','$detalle','$fecha','$fuente','$comentario','$pathImagen',0,0,0,0)";
     $result= mysqli_query($bd,$sql);

     if($result){
       $mandar['mensaje'] = 'SE CREO CON EXITO EL HITO, LOS ADMINISTRADORES LO REVISARAN Y LO ACEPTARAN SI ES PERTINENTE, DE CUALQUIER FORMA SE PUEDE OBSERVAR EL HITO';
       $mandar['result'] = true;
        echo json_encode($mandar);
     }else{
       $mandar['mensaje'] = 'ERROR, EXISTIERON PROBLEMAS AL PROCESAR LA PETICION DE CREACION DE HITO, Detalles: '.mysqli_error($bd);
       $mandar['result'] = false;
       echo json_encode($mandar);
     }
   }else{
     $mandar['mensaje'] = 'NO SE LOGRO SUBIR LA IMAGEN POR LO TANTO, NO SE TERMINO DE PROCESAR EL HITO';
     $mandar['result'] = false;
      echo json_encode($mandar);
   }
}else{
  $mandar['mensaje'] = 'LA EXTENSION DE LA IMAGEN NO ES CORRECTA, LAS EXTENSIONES VALIDAS SON: jpg, jpeg, png y pdf';
  $mandar['result'] = false;
   echo json_encode($mandar);
}

exit;

?>
