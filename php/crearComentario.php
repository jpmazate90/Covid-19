
<?php

include("../conexion.php");

$bd = conectar();
$sql = "SELECT Comentario FROM contadorImagenes";
$result= mysqli_query($bd,$sql);

while($mostrar=mysqli_fetch_array($result)){
    $valor = $mostrar['Comentario'];
}
$numeroValor = (int) $valor;

$sql = "UPDATE contadorImagenes SET Comentario= $numeroValor+1 WHERE Id=1";
$result= mysqli_query($bd,$sql);


// File name
$filename = $_FILES['file']['name'];

// Valid file extensions
$valid_extensions = array("jpg","jpeg","png","pdf");

// File extension
$extension = pathinfo($filename, PATHINFO_EXTENSION);


$usuario = $_POST['usuario'];
$comentario = $_POST['comentario'];
$idHito = $_POST['idHito'];
$tipo = $_POST['tipo'];

// Check extension
if(in_array(strtolower($extension),$valid_extensions) ) {

   // Upload file
   $pathImagen = "../images/comentarios/".$usuario.'G'.$numeroValor.'G'.$filename;

   if(move_uploaded_file($_FILES['file']['tmp_name'], $pathImagen)){

     $sql = "INSERT INTO comentarioHito(Usuario, IdHito, Comentario, Likes, Dislikes, Imagen, Estado) VALUES(
        '$usuario','$idHito','$comentario',0,0,'$pathImagen',0)";
     $result= mysqli_query($bd,$sql);

     if($result){
       $mandar['mensaje'] = 'Se comento con exito';
       $mandar['result'] = true;
        echo json_encode($mandar);
     }else{
       $mandar['mensaje'] = 'ERROR, EXISTIERON PROBLEMAS AL PROCESAR LA PETICION, Detalles: '.mysqli_error($bd);
       $mandar['result'] = false;
       echo json_encode($mandar);
     }
   }else{
     $mandar['mensaje'] = 'NO SE LOGRO SUBIR LA IMAGEN POR LO TANTO, NO SE TERMINO DE PROCESAR EL COMENTARIO';
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
